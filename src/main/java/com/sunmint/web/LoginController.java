package com.sunmint.web;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.*;
import org.springframework.web.servlet.ModelAndView;

import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

/**
 * Created by pipe on 2/26/17.
 */

@Controller
public class LoginController {

    private UserService userService;

    @Autowired
    public void setUserService(UserService userService) {
        this.userService = userService;
    }

/*    @PostMapping("/login")
    public String login(@RequestParam Map<String , String> requestParams, Model model) {
        String user = requestParams.get("email");
        String password = requestParams.get("password");

        User dbuser = userService.getUserByUserName(user);

        if(dbuser.getEmail().equals(user) && dbuser.getPassword().equals(password)) {
            model.addAttribute("user", dbuser.getName());
            return "portals";
        }

        return "index";
    }*/

    @RequestMapping(value="/login",method=RequestMethod.GET)
    public ModelAndView displayLogin(HttpServletRequest request, HttpServletResponse response, User user) {
        ModelAndView model = new ModelAndView("login");
        //LoginBean loginBean = new LoginBean();
        model.addObject("user", user);
        return model;
    }

    @RequestMapping(value="/login",method=RequestMethod.POST)
    public ModelAndView executeLogin(HttpServletRequest request, HttpServletResponse response, @ModelAttribute("user")User user, Model modelU) {
        ModelAndView model= null;
        try
        {
            boolean isValidUser = userService.isValidUser(user.getEmail(), user.getPassword());
            if(isValidUser)
            {
                System.out.println("User Login Successful");
                request.setAttribute("loggedInUser", user.getEmail());
                model = new ModelAndView("portals");
                modelU.addAttribute("name",userService.getUserByEmail(user.getEmail()).getName());
            }
            else
            {
                model = new ModelAndView("login");
                request.setAttribute("message", "Invalid credentials!!");
            }

        }
        catch(Exception e)
        {
            e.printStackTrace();
        }

        return model;
    }
}

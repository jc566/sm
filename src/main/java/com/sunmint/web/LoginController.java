package com.sunmint.web;

import org.apache.log4j.Logger;
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

    private Logger log = Logger.getLogger(WebappApplication.class);

    @Autowired
    public void setUserService(UserService userService) {
        this.userService = userService;
    }
    
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
                log.info("User logged in - email " + user.getEmail());
                request.setAttribute("loggedInUser", user.getEmail());
                model = new ModelAndView("portals");
                modelU.addAttribute("name",userService.getUserByEmail(user.getEmail()).getName());
            }
            else
            {
                model = new ModelAndView("login");
                request.setAttribute("message", "Invalid credentials!!");
                log.info("User logged in fail - email " + user.getEmail());
            }

        }
        catch(Exception e)
        {
            e.printStackTrace();
        }

        return model;
    }
}

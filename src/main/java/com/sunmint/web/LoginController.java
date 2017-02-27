package com.sunmint.web;

import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;
import java.util.Map;

/**
 * Created by pipe on 2/26/17.
 */
public class LoginController {

    @RequestMapping("/login")
    public String login(@RequestParam Map<String , String> requestParams) {
        String user = requestParams.get("User");
        String password = requestParams.get("password");

        return "portals";
    }
}

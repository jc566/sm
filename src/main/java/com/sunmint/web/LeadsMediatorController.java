package com.sunmint.web;

import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;

/**
 * Created by pipe on 3/9/17.
 */

@Controller
public class LeadsMediatorController {
    @RequestMapping(value = "/leads", method = RequestMethod.GET)
    public String getLeadsPage() {
        // This will resolve to /WEB-INF/jsp/users.jsp page
        return "jq_grid";
    }
}

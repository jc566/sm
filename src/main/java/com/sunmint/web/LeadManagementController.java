package com.sunmint.web;

import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;
import org.springframework.web.servlet.View;

/**
 * Created by pipe on 2/27/17.
 */

@Controller
public class LeadManagementController {
    @RequestMapping(value = "/leadManagement", method = RequestMethod.GET)
    public String displayLeadManagementPage() {
        return "jq_grid";
    }
}

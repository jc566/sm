package com.sunmint.web;

import org.apache.log4j.Logger;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.*;

/**
 * Created by pipe on 2/27/17.
 */

@Controller
public class LeadFormController {
    private LeadService leadService;

    private Logger log = Logger.getLogger(WebappApplication.class);

    @Autowired
    public void setLeadService(LeadService leadService) {
        this.leadService = leadService;
    }


    @GetMapping("/createLead")
    public String leadForm(Model model) {
        model.addAttribute("createLead", new Lead());
        return "createLead";
    }

    @PostMapping("/createLead")
    public String leadSubmit(@ModelAttribute Lead lead) {
        leadService.saveLead(lead);
        log.info("Lead saved - email " + lead.getEmail());
        return "createLead";
    }

/*    @RequestMapping(value = "createLead", method = RequestMethod.POST)
    public String saveLead(Lead lead){
        leadService.saveLead(lead);
        log.info("Lead saved - email " + lead.getEmail());
        return "redirect:/createLead/" + lead.getEmail();
    }

    @RequestMapping("createLead/new")
    public String newProduct(Model model){
        model.addAttribute("createLead", new Lead());
        return "createLead";
    }*/
}

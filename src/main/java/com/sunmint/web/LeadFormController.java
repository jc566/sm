package com.sunmint.web;

import org.apache.log4j.Logger;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.*;
import com.google.common.collect.Lists;
import java.util.List;

/**
 * Created by pipe on 2/27/17.
 */

@Controller
@RequestMapping("/crud")
public class LeadFormController {
    private LeadService leadService;
    private Logger log = Logger.getLogger(WebappApplication.class);

    @Autowired
    public void setLeadService(LeadService leadService) {
        this.leadService = leadService;
    }


    @RequestMapping(method = RequestMethod.GET)
    public @ResponseBody CustomLeadResponse getAll() {
        List<Lead> leads = Lists.newArrayList(leadService.listAllLeads());
        CustomLeadResponse response = new CustomLeadResponse();

        response.setRows(leads);
        response.setRecords(String.valueOf(leads.size()));

        //TODO Dummy Values. Must be implemented
        response.setPage("1");
        response.setTotal("10");

        return response;
    }

    @RequestMapping(value = "/edit", method = RequestMethod.POST)
    public @ResponseBody CustomGenericResponse edit(
            @RequestParam("email") String email,
            @RequestParam("firstName") String firstName,
            @RequestParam("middleName") String middleName,
            @RequestParam("lastName") String lastName,
            @RequestParam("street") String street,
            @RequestParam("city") String city,
            @RequestParam("state") String state,
            @RequestParam("zip") String zip,
            @RequestParam("customerType") String customerType,
            @RequestParam("monthlyBill")  String monthlyBill,
            @RequestParam("monthlyUsage") String monthlyUsage,
            @RequestParam("carrier") String carrier,
            @RequestParam("comments") String comments,
            @RequestParam("billFile") String billFile,
            @RequestParam("telephone") String telephone
            ) {

        log.info("Received request to edit user");

        // Construct our user object
        // Assign the values from the

        Lead lead = new Lead(email,firstName,middleName,lastName,city,state,zip,customerType,Integer.valueOf(monthlyBill),Integer.valueOf(monthlyUsage),carrier,telephone,comments,billFile);
        leadService.editLead(lead);
        // Do custom validation here or in your service

        // Call service to edit
        Lead success = leadService.editLead(lead);

        // Check if successful
        if ( success == null ) {
            // A failure. Return a custom response as well
            CustomGenericResponse response = new CustomGenericResponse();
            response.setSuccess(false);
            response.setMessage("Action failure!");
            return response;

        } else {
            // Success. Return a custom response
            CustomGenericResponse response = new CustomGenericResponse();
            response.setSuccess(true);
            response.setMessage("Action successful!");
            return response;
        }

    }

    /**
     * Add a new user
     */
    @RequestMapping(value = "/add", method = RequestMethod.POST)
    public @ResponseBody CustomGenericResponse add(
            @RequestParam("email") String email,
            @RequestParam("firstName") String firstName,
            @RequestParam("middleName") String middleName,
            @RequestParam("lastName") String lastName,
            @RequestParam("street") String street,
            @RequestParam("city") String city,
            @RequestParam("state") String state,
            @RequestParam("zip") String zip,
            @RequestParam("customerType") String customerType,
            @RequestParam("monthlyBill")  String monthlyBill,
            @RequestParam("monthlyUsage") String monthlyUsage,
            @RequestParam("carrier") String carrier,
            @RequestParam("comments") String comments,
            @RequestParam("billFile") String billFile,
            @RequestParam("telephone") String telephone
    ) {
        log.info("Received request to add a new user");

        // Construct our new user object. Take note the id is not required.
        // Assign the values from the parameters
        Lead lead = new Lead(email,firstName,middleName,lastName,city,state,zip,customerType,Integer.valueOf(monthlyBill),Integer.valueOf(monthlyUsage),carrier,telephone,comments,billFile);

        // Do custom validation here or in your service

        // Call service to add
        Lead success = leadService.saveLead(lead);

        // Check if successful
        if (success == null) {
            CustomGenericResponse response = new CustomGenericResponse();
            response.setSuccess(false);
            response.setMessage("Action failure!");
            return response;

        }
        else {
            CustomGenericResponse response = new CustomGenericResponse();
            response.setSuccess(true);
            response.setMessage("Action successful!");
            return response;
        }

    }

    /**
     * Delete an existing user
     */
    @RequestMapping(value = "/delete", method = RequestMethod.POST)
    public @ResponseBody CustomGenericResponse delete(
            @RequestParam("email") String email
    ) {

        log.debug("Received request to delete an existing lead");
        leadService.deleteLead(email);
        CustomGenericResponse response = new CustomGenericResponse();
        response.setSuccess(true);
        response.setMessage("Action successful!");
        return response;

    }

/*
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
        return "redirect:/leads";
    }

    @RequestMapping(value = "/leads", method = RequestMethod.GET)
    public String list(Model model){
        model.addAttribute("leads", leadService.listAllLeads());
        return "leads";
    }*/

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

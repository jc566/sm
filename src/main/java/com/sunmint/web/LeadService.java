package com.sunmint.web;

/**
 * Created by pipe on 2/27/17.
 */

public interface LeadService {
    Iterable<Lead> listAllLeads();

    Lead saveLead(Lead lead);

    void deleteLead(String email);

    Lead getLeadByEmail(String email);
}

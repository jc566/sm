package com.sunmint.web;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

/**
 * Created by pipe on 2/27/17.
 */

@Service
public class LeadServiceImpl implements LeadService {
    private LeadRepository leadRepository;

    @Autowired
    public void setLeadRepository(LeadRepository leadRepository) {
        this.leadRepository = leadRepository;
    }

    @Override
    public Iterable<Lead> listAllLeads() {
        return leadRepository.findAll();
    }

    @Override
    public Lead saveLead(Lead lead) {
        return leadRepository.save(lead);
    }

    @Override
    public void deleteLead(String email) {
        leadRepository.delete(email);
    }

    @Override
    public Lead getLeadByEmail(String email) {
        return leadRepository.findOne(email);
    }
}

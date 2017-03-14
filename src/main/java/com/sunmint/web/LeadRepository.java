package com.sunmint.web;

import org.springframework.data.repository.CrudRepository;
import org.springframework.stereotype.Repository;

/**
 * Created by pipe on 2/27/17.
 */

@Repository
public interface LeadRepository extends CrudRepository<Lead,String>{
}

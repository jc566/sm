package com.sunmint.web;

import org.springframework.data.repository.CrudRepository;
import org.springframework.stereotype.Repository;

/**
 * Created by pipe on 2/26/17.
 */

@Repository
public interface UserRepository extends CrudRepository<User,String> {
}

package com.sunmint.web;

/**
 * Created by pipe on 2/26/17.
 */

public interface UserService {
    Iterable<User> listAllUsers();

    User saveUser(User user);

    void deleteUser(String userName);

    User getUserByEmail(String email);

    boolean isValidUser(String userName, String password);

}

package com.sunmint.web;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

/**
 * Created by pipe on 2/26/17.
 */

@Service
public class UserServiceImpl implements UserService {
    private UserRepository userRepository;

    @Autowired
    public void setUserRepository(UserRepository userRepository) {
        this.userRepository = userRepository;
    }

    @Override
    public Iterable<User> listAllUsers() {
        return userRepository.findAll();
    }

    @Override
    public User saveUser(User user) {
        return userRepository.save(user);
    }

    @Override
    public void deleteUser(String userName) {
        userRepository.delete(userName);
    }

    @Override
    public User getUserByEmail(String email) {
        return userRepository.findOne(email);
    }

    @Override
    public boolean isValidUser(String email, String password) {
        if(!userRepository.exists(email))
            return false;

        User user = userRepository.findOne(email);
        if(user.getEmail().equals(email) && user.getPassword().equals(password))
            return true;
        else
            return false;
    }

}

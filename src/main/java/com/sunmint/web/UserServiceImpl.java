package com.sunmint.web;

/**
 * Created by pipe on 2/26/17.
 */

public class UserServiceImpl implements UserService {
    private UserRepository userRepository;

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
    public User getUserByUserName(String userName) {
        return userRepository.findOne(userName);
    }

}

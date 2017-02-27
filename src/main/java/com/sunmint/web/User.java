package com.sunmint.web;

import lombok.Data;

import javax.persistence.*;

/**
 * Created by pipe on 2/26/17.
 */

@Entity
@Data
public class User {
    @Version
    private Integer version;

    @Id
    private String userName;

    public Integer getVersion() {
        return version;
    }

    public void setVersion(Integer version) {
        this.version = version;
    }

    public String getUserName() {
        return userName;
    }

    public void setUserName(String userName) {
        this.userName = userName;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getPassword() {
        return password;
    }

    public void setPassword(String password) {
        this.password = password;
    }

    private String name;
    private String password;

    public User(String name, String userName, String password) {
        this.name = name;
        this.userName = userName;
        this.password = password;
    }

    public User(){}
}

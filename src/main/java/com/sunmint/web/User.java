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
    private String email;

    private String name;
    private String password;
    private String type;

    public User(String name, String email, String password, String type) {
        this.name = name;
        this.email = email;
        this.password = password;
        this.type = type;
    }

    public User(){}

    public Integer getVersion() {
        return version;
    }

    public void setVersion(Integer version) {
        this.version = version;
    }

    public String getEmail() {
        return email;
    }

    public void setEmail(String email) {
        this.email = email;
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

}

package com.sunmint.web;

import lombok.Data;

import javax.persistence.Entity;
import javax.persistence.Id;
import javax.persistence.Version;

/**
 * Created by pipe on 2/27/17.
 */

@Entity
@Data
public class Lead {
    @Version
    private Integer version;

    @Id
    private String email;

    private String firstName;
    private String middleName;
    private String lastName;
    private String street;
    private String city;
    private String state;
    private String zip;
    private String customerType;
    private Integer monthlyBill;
    private Integer monthlyUsage;
    private String carrier;
    private String comments;
    private String billFile;
    private String telephone;

    public Lead(String email, String firstName, String middleName, String lastName, String city, String state, String zip, String customerType, Integer monthlyBill, Integer monthlyUsage, String carrier, String telephone,String comments, String billFile) {
        this.email = email;
        this.firstName = firstName;
        this.middleName = middleName;
        this.lastName = lastName;
        this.city = city;
        this.state = state;
        this.zip = zip;
        this.monthlyBill = monthlyBill;
        this.monthlyUsage = monthlyUsage;
        this.carrier = carrier;
        this.customerType = customerType;
        this.telephone = telephone;
        this.comments = comments;
        this.billFile = billFile;
    }

    public Lead() {
    }

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

    public String getFirstName() {
        return firstName;
    }

    public void setFirstName(String firstName) {
        this.firstName = firstName;
    }

    public String getMiddleName() {
        return middleName;
    }

    public void setMiddleName(String middleName) {
        this.middleName = middleName;
    }

    public String getLastName() {
        return lastName;
    }

    public void setLastName(String lastName) {
        this.lastName = lastName;
    }

    public String getCity() {
        return city;
    }

    public void setCity(String city) {
        this.city = city;
    }

    public String getState() {
        return state;
    }

    public void setState(String state) {
        this.state = state;
    }

    public String getZip() {
        return zip;
    }

    public void setZip(String zip) {
        this.zip = zip;
    }

    public Integer getMonthlyBill() {
        return monthlyBill;
    }

    public void setMonthlyBill(Integer monthlyBill) {
        this.monthlyBill = monthlyBill;
    }

    public Integer getMonthlyUsage() {
        return monthlyUsage;
    }

    public void setMonthlyUsage(Integer monthlyUsage) {
        this.monthlyUsage = monthlyUsage;
    }

    public String getCarrier() {
        return carrier;
    }

    public void setCarrier(String carrier) {
        this.carrier = carrier;
    }

    public void setStreet(String street) {
        this.street = street;
    }

    public String getStreet() {
        return street;
    }

    public String getComments() {
        return comments;
    }

    public void setComments(String comments) {
        this.comments = comments;
    }

    public String getBillFile() {
        return billFile;
    }

    public void setBillFile(String billFile) {
        this.billFile = billFile;
    }

    public String getCustomerType() {
        return customerType;
    }

    public void setCustomerType(String customerType) {
        this.customerType = customerType;
    }

    public String getTelephone() {
        return telephone;
    }

    public void setTelephone(String telephone) {
        this.telephone = telephone;
    }
}

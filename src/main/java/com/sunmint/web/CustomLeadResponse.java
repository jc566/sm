package com.sunmint.web;

import java.util.List;

/**
 * Created by pipe on 3/8/17.
 */
public class CustomLeadResponse {
    /**
     * Current page of the query
     */
    private String page;

    /**
     * Total pages of the query
     */
    private String total;
    /**
     * Total number of records for the query
     */
    private String records;
    /**
     * Array containing the Leads
     */
    private List<Lead> rows;

    public CustomLeadResponse(){}

    public String getPage() {
        return page;
    }

    public void setPage(String page) {
        this.page = page;
    }

    public String getTotal() {
        return total;
    }

    public void setTotal(String total) {
        this.total = total;
    }

    public String getRecords() {
        return records;
    }

    public void setRecords(String records) {
        this.records = records;
    }

    public List<Lead> getRows() {
        return rows;
    }

    public void setRows(List<Lead> rows) {
        this.rows = rows;
    }
}

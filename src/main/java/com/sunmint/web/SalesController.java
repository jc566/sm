package com.sunmint.web;

import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.servlet.View;

/**
 * Created by pipe on 2/27/17.
 */

@Controller
public class SalesController {
    @RequestMapping("/sales")
    public String displaySalesPage() {
        return "sales";
    }
}

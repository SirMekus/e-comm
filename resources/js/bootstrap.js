import axios from "axios";
import { postRequestEvent, element as $, moneyFormat } from "mmuo";
import { DisplayAsToast } from "ije";

async function fetchProducts(url) {
    try {
        const response = await axios.get(url);
        return response.data;
    } catch (error) {
        let message =
            error.response?.data?.message ||
            error.response?.data?.data?.message ||
            error.response.data ||
            "Something went wrong. Please try again";

        DisplayAsToast(message, false);
    }
}

function getProductsToDisplay() {
    fetchProducts("/products").then((response) => {
        if (response.length > 0) {
            const products = $(".products", false);
            if (products.contains("hide")) {
                products.removeClass("hide");
            }
            let total = 0;
            const tableBody = document.querySelector("table tbody");
            tableBody.innerHTML = null;
            response.forEach((item) => {
                total += (item.quantity * item.price);
                const row = document.createElement("tr");
                row.innerHTML = `
                <td>${item.product_name}</td>
                <td>${item.quantity}</td>
                <td>${item.amount_formatted} ${item.currency}</td>
                <td>${item.created_at_formatted}</td>
                <td>${moneyFormat(
                    item.quantity * item.price,
                    item.currency
                )}</td>
                <td><a href='/${
                    item.id
                }' class="btn btn-primary btn-sm">Edit</a></td>
            `;
                tableBody.appendChild(row);
            });

            $(".total-value", false).text(moneyFormat(total, "NGN"));
        }
    });
}

window.addEventListener("DOMContentLoaded", function () {
    postRequestEvent();

    document.addEventListener("created", (response) => {
        document
            .querySelector("#form")
            .querySelectorAll("input")
            .forEach(function (currentValue, currentIndex, listObj) {
                var currentNode = listObj[currentIndex];
                currentNode.value = null;
            });
        getProductsToDisplay();
    });
    getProductsToDisplay();
});

window.axios = axios;

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
window.axios.defaults.headers.common["Accept"] = "application/json";

window.axios.defaults.withCredentials = true;

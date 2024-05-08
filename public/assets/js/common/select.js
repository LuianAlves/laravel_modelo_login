export function selectBudget(budgetId = null) {
    var budgetAnalyticIds = [];

    $.ajax({
        type: "GET",
        url: "/budget-analytic-api",
        success: function (response) {
            if (Array.isArray(response.data)) {
                response.data.forEach(function (item) {
                    budgetAnalyticIds.push(item.budget.id);
                });
            } else {
                console.error("A propriedade 'data' não é um array na resposta da API:", response);
            }

            fetchBudgets(budgetId, budgetAnalyticIds);
        },
        error: function (xhr) {
            console.error(xhr.responseText);
        },
        async: false
    });
}

function fetchBudgets(budgetId, budgetAnalyticIds) {
    $.ajax({
        type: "GET",
        url: "/budget-api",
        success: function (response) {
            var select = $("#budget_id");

            select.empty();

            if (Array.isArray(response.data)) {
                select.append('<option selected disabled>Selecione um orçamento</option>');
                response.data.forEach(function (budget) {
                    if(budget.status == 3) {
                        if (budgetId && budgetId == budget.id) {
                            var option = $('<option></option>').attr('value', budget.id).text(budget.name + ' - R$ ' + budget.price);
                            select.append(option);
                        } else {
                            if (!budgetAnalyticIds.includes(budget.id)) {
                                var option = $('<option></option>').attr('value', budget.id).text(budget.name + ' - R$ ' + budget.price);
                                select.append(option);
                            }
                        }
                    }
                });
            } else {
                console.error("A propriedade 'data' não é um array na resposta da API:", response);
            }
        },
        error: function (xhr) {
            console.error(xhr.responseText);
        }
    });
}

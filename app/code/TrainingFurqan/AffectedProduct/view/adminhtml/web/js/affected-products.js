define([
    'mage/adminhtml/grid'
], function () {
    'use strict';
    return function (config) {
        var selectedProducts = config.selectedProducts,
            categoryProducts = $H(selectedProducts),
            gridJsObject = window[config.gridJsObjectName],
            tabIndex = 1000;
        
        $('affected_products').value = Object.toJSON(categoryProducts);
      
        function registerCategoryProduct(grid, element, checked) {
            if (checked) {
                if (element.positionElement) {
                    element.positionElement.disabled = false;
                    categoryProducts.set(element.value, element.positionElement.value);
                }
            } else {
                if (element.positionElement) {
                    element.positionElement.disabled = true;
                }
                categoryProducts.unset(element.value);
            }
            $('affected_products').value = Object.toJSON(categoryProducts);
            grid.reloadParams = {
                'selected_products[]': categoryProducts.keys()
            };
        }
      
        function categoryProductRowClick(grid, event) {
            var trElement = Event.findElement(event, 'tr'),
                isInput = Event.element(event).tagName === 'INPUT',
                checked = false,
                checkbox = null;
            if (trElement) {
                checkbox = Element.getElementsBySelector(trElement, 'input');
                if (checkbox[0]) {
                    checked = isInput ? checkbox[0].checked : !checkbox[0].checked;
                    gridJsObject.setCheckboxChecked(checkbox[0], checked);
                }
            }
        }
    
        function positionChange(event) {
            var element = Event.element(event);
            if (element && element.checkboxElement && element.checkboxElement.checked) {
                categoryProducts.set(element.checkboxElement.value, element.value);
                $('affected_products').value = Object.toJSON(categoryProducts);
            }
        }
      
        function categoryProductRowInit(grid, row) {
            var checkbox = $(row).getElementsByClassName('checkbox')[0],
                position = $(row).getElementsByClassName('input-text')[0];
            if (checkbox && position) {
                checkbox.positionElement = position;
                position.checkboxElement = checkbox;
                position.disabled = !checkbox.checked;
                position.tabIndex = tabIndex++;
                Event.observe(position, 'keyup', positionChange);
            }
        }
        gridJsObject.rowClickCallback = categoryProductRowClick;
        gridJsObject.initRowCallback = categoryProductRowInit;
        gridJsObject.checkboxCheckCallback = registerCategoryProduct;
        if (gridJsObject.rows) {
            gridJsObject.rows.each(function (row) {
                categoryProductRowInit(gridJsObject, row);
            });
        }
    };
});
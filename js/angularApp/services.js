"use strict";
myAdminApp.service("Categories",function ($http) {
   
    return {
        
        fetch : function() {
            return $http.get("/ESN-BackEnd-clean/ESN-BackEnd/getCategories.php");
        }
    };
});

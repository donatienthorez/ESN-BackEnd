"use strict";
myAdminApp.service("Categories",function ($http) {
   
    return {
        
        fetch : function() {
            return $http.get("/ESN-BackEnd/getCategories.php");
        },
        updateName : function(id,name) {
            return $http.get("/ESN-BackEnd/updateNameCategories.php",{params: { id:id, name:name}});
        },
        updateContent : function(id,content) {
            return $http.get("/ESN-BackEnd/updateContentCategories.php",{params: { id:id, content:content}});
        }
    };
});

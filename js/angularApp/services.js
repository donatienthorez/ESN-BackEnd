"use strict";
myAdminApp.service("Categories",function ($http) {
   
    return {
        
	add : function(name,content,parent) {
	    return $http.get("/ESN-BackEnd/includes/rest/addCategory.php",{params: { name:name, content:content, parent:parent}});
	},
        fetch : function() {
            console.log("test");
            return $http.get("/ESN-BackEnd/includes/rest/getCategories.php");
        },
        del : function(id) {
            return $http.get("/ESN-BackEnd/includes/rest/deleteCategory.php",{params: { id:id}});
        },
        updateName : function(id,name) {
            return $http.get("/ESN-BackEnd/includes/rest/updateNameCategories.php",{params: { id:id, name:name}});
        },
        updateContent : function(id,content) {
            return $http.get("/ESN-BackEnd/includes/rest/updateContentCategories.php",{params: { id:id, content:content}});
        }
    };
});

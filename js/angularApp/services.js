"use strict";
myAdminApp.service("Categories",function ($http) {
   
    return {
        
	add : function(name,content,parent,position) {
	    return $http.get("/survivalGuide/includes/rest/addCategory.php",{params: { name:name, content:content, parent:parent, position:position}});
	},
        fetch : function() {
            return $http.get("/survivalGuide/includes/rest/getCategories.php");
        },
        del : function(id) {
            return $http.get("/survivalGuide/includes/rest/deleteCategory.php",{params: { id:id}});
        },
        updateName : function(id,name) {
            return $http.get("/survivalGuide/includes/rest/updateNameCategories.php",{params: { id:id, name:name}});
        },
        updateContent : function(id,content) {
            return $http.get("/survivalGuide/includes/rest/updateContentCategories.php",{params: { id:id, content:content}});
        },
	updatePosition : function(id,position) {
            return $http.get("/survivalGuide/includes/rest/updatePositionCategories.php",{params: { id:id, position:position}});
        }
    };
});

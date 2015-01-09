"use strict";
myAdminApp.controller("categoriesController" ,function ($scope, Categories) {

    $scope.categories=[];
    $scope.categorie="";
     
    Categories.fetch().success(function(resp){
        $scope.categories = resp.categories;
    });
    
     $scope.getCategorie = function(id)
     {
                
         var index,index2,index3;
         for(index=0; index<$scope.categories.length;++index)
         {
             if($scope.categories[index].id == id)
             {
                 $scope.categorie=$scope.categories[index];
        
             }
             if(($scope.categories[index].categories).length>0)
             {
                 for(index2=0;index2<$scope.categories[index].categories.length;++index2)
                 {
                     if($scope.categories[index].categories[index2].id== id)
                     {
                         $scope.categorie=$scope.categories[index].categories[index2];
                     }
                     if($scope.categories[index].categories[index2].categories.length>0)
                     {
                        for(index3=0;index3<$scope.categories[index].categories.length;++index3)
                        {
                           if($scope.categories[index].categories[index2].categories[index3].id== id)
                            {
                                $scope.categorie=$scope.categories[index].categories[index2].categories[index3];
                            } 
                        } 
                     }   
                 }
             }
         }
     };
     $scope.changeCategorieName = function(id,name)
     {
		Categories.updateName(id,name).success(function(resp){
			Categories.fetch().success(function(resp){
			$scope.categories = resp.categories;
			});
		});
	 };
	 
	 $scope.changeCategorieContent = function(id,content)
     {
		Categories.updateContent(id,content).success(function(resp){
			Categories.fetch().success(function(resp){
			$scope.categories = resp.categories;
			});
		});
	 };
	 
	 $scope.deleteCategory = function(id)
     {
		Categories.del(id).success(function(resp){
			Categories.fetch().success(function(resp){
			$scope.categories = resp.categories;
			});
		});
		window.location.reload();
	 };
	 
     
		 
});



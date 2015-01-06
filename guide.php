<div class="subnavbar">
	<div class="subnavbar-inner">
			<div class="container">
			  <div class="mainnav">
				  
			  </div>
			</div>
			  
			<div class="container"  ng-controller="categoriesController">
				<div class="span5">
					<div class="widget">
						<div class="widget-header"> 
							<i class="icon-book"></i>
							<h3>Menu List Tree</h3>
						</div>
						<div class="widget-content">
							<ul ng-repeat="categorie in categories">
								<a><li ng-click="getCategorie(categorie.id); editableForm.$cancel()">{{categorie.name}}</li></a>
								<ul ng-repeat="categorie2 in categorie.categories">
									<a><li ng-click="getCategorie(categorie2.id); editableForm.$cancel()">{{categorie2.name}}</li></a>
									<ul ng-repeat="categorie3 in categorie2.categories">
										<a><li ng-click="getCategorie(categorie3.id); editableForm.$cancel()">{{categorie3.name}}</li></a>
									<ul>
								<ul>
							</ul> 
						</div>
					</div>
				</div>
				<form editable-form name="editableForm">
				<div class="span6">
					<div class="widget">
						<div class="widget-header"> 
							<i class="icon-book"></i>
							
							<!--
							<h3 editable-text="categorie.name" onaftersave="changeCategorieName(categorie.id,categorie.name)"> {{ categorie.name }} </h3>
  							-->
							
  
								
							  <h3 editable-text="categorie.name" e-form="textBtnForm" onaftersave="changeCategorieName(categorie.id,categorie.name)">
								   {{ categorie.name }}
							  </h3>
						  
						  
						  
							  <button type="button" class="btn btn-default" ng-click="editableForm.$show()" ng-show="!editableForm.$visible">
								Edit
							  </button>
							  <!-- buttons to submit / cancel form -->
							  <span ng-show="editableForm.$visible">
								<button type="submit" class="btn btn-primary" ng-disabled="editableForm.$waiting">
								  Save
								</button>
								<button type="button" class="btn btn-default" ng-disabled="editableForm.$waiting" ng-click="editableForm.$cancel()">
								  Cancel
								</button>
							  </span>
						</div>
						<div class="widget-content">	
							<div ng-if="categorie.content" editable-textarea="categorie.content" e-form="contentBtnForm" e-rows="7" e-cols="50"  onaftersave="changeCategorieContent(categorie.id,categorie.content)">
							<pre>{{ categorie.content }}</pre>
							</div>
							<div ng-if="!categorie.content">
								<ul ng-repeat="categorie2 in categorie.categories">
									<a><li ng-click="getCategorie(categorie2.id); editableForm.$cancel()">{{categorie2.name}}</li></a>
								</ul>
							</div>
						</div>
							
					</div>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>

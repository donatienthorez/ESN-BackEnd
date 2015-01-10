<div class="subnavbar" ng-controller="categoriesController">
	<div class="subnavbar-inner">
			<div class="container">
				<div class="mainnav">
					<a href="#Add" role="button" class="btn btn-primary" data-toggle="modal">Add category</a>
					<div id="Add" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        	                <div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h3 id="myModalLabel">Add category</h3>
                                                </div>
                                                <div class="modal-body">
                                                	<div class="control-group">											
								<label class="control-label" for="name">Name</label>
								<div class="controls">
									<input type="text" class="span5" id="name"ng-model="name">
								</div> <!-- /controls -->				
							</div>
							<div class="control-group">											
								<label class="control-label" for="Content">Content</label>
								<div class="controls">
									<textarea type="text" class="span5" id="content" rows="10" cols="50" ng-model="content"></textarea>
								</div> <!-- /controls -->				
							</div>
							<div class="control-group">											
								<label class="control-label" for="Parent">Parent</label>
								<div class="controls">
									<select ng-model="parent">
										<option value="">-- Root --</option>
										<option ng-repeat="categorie in categories" value="{{categorie.id}}"> {{ categorie.name }}</option>
										
										<optgroup ng-if="categorie.categories.length" ng-repeat="categorie in categories" label="{{ categorie.name }}">
											<option ng-repeat="categorie2 in categorie.categories" value="{{categorie2.id}}">{{ categorie2.name }}</option>
										</optgroup>
									
									</select><br>
								</div> <!-- /controls -->				
							</div>
                                                </div>
                                                <div class="modal-footer">
                                                	<button class="btn btn-primary" ng-click="addCategory(name,content,parent);">Save</button>
                                                	<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
                                                </div>
					</div>
			  	</div>
			  
				<div>
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
					<div class="span5">
				
						<div class="widget">
							<form editable-form name="editableForm">
							<div class="widget-header"> 
								<i class="icon-book"></i>
							
								<!--
								<h3 editable-text="categorie.name" onaftersave="changeCategorieName(categorie.id,categorie.name)"> {{ categorie.name }} </h3>
	  							-->
							
	  
								
								  <h3 editable-text="categorie.name" e-form="textBtnForm" onaftersave="changeCategorieName(categorie.id,categorie.name)">
									   {{ categorie.name }}
								  </h3>
							  
							  
							  	  <span ng-if="categorie.name">	
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
									  <button type="button" class="btn btn-default" ng-click="deleteCategory(categorie.id);">
										Delete
									  </button>
								  </span>
							</div>
							<!-- end widget head -->

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
							<!-- end widget content -->
							</form>
						
						</div>
						<!-- end widget -->
					</div>
					<!-- end span 5 -->
				</div>
			</div>
		</div>
	</div>
</div>

<div class="subnavbar">
	<div class="subnavbar-inner">
			<div class="container">
					<ul class="mainnav">
					 <li class="active"><a href="index.php"><i class="icon-list-alt"></i><span>Survival Guide</span> </a> </li>
					 <li class=""><a href="notifications.php"><i class="icon-exclamation-sign"></i><span>Notifications</span> </a> </li>
					</ul>
			</div>
	</div>
</div>
<div ng-controller="categoriesController">
	<div class = "main-inner">
		<div class="container"</div>
			<div class="span5">
				<div class="widget">
					<div class="widget-header"> 
						<i class="icon-book"></i>
						<h3>Menu List Tree</h3>
						<span>							
							<a href="#Add" role="button" data-toggle="modal" style="margin-bottom : 15px;">
							<button type="button" class="btn btn-default">Add Category</button></a>				
						</span>
					</div>
					<div class="widget-content">
						<ul ng-repeat="categorie in categories">
							<a class="categorie"><li ng-click="getCategorie(categorie.id); editableForm.$cancel()">{{categorie.name}}</li></a>
							<ul ng-repeat="categorie2 in categorie.categories">
									<a class="categorie"><li ng-click="getCategorie(categorie2.id); editableForm.$cancel()">{{categorie2.name}}</li></a>
									<ul ng-repeat="categorie3 in categorie2.categories">
										<a class="categorie"><li ng-click="getCategorie(categorie3.id); editableForm.$cancel()">{{categorie3.name}}</li></a>
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
							<h3 editable-text="categorie.name" e-form="textBtnForm" onaftersave="changeCategorieName(categorie.id,categorie.name)">
								{{ categorie.name }}
							</h3>
							<span ng-if="categorie.name">	
								<button type="button" class="btn btn-default" ng-click="editableForm.$show()" ng-show="!editableForm.$visible">
								Edit
								</button>
								<!-- buttons to submit / cancel form -->
								<span ng-show="editableForm.$visible">
									<button type="submit" class="btn btn-primary" ng-disabled="editableForm.$waiting">Save</button>
									<button type="button" class="btn btn-default" ng-disabled="editableForm.$waiting" ng-click="editableForm.$cancel()">Cancel</button>
								</span>

								<a href="#delete" role="button" class="btn btn-default" data-toggle="modal">Delete</a>

								<div id="delete" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										<h3 id="myModalLabel">Delete category</h3>
									</div>
									<div class="modal-body">
										<div class="control-group">											
											<label class="control-label" for="name">{{ categorie.name }}</label>
											<div class="controls">
												<p> Are you sure to delete this category (and this subcategory) ?
											</div> <!-- /controls -->				
										</div>

									</div>
									<div class="modal-footer">
										<button class="btn btn-primary" ng-click="deleteCategory(categorie.id);">Delete</button>
										<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
									</div>
								</div>
							</span>
						</div>
						<!-- end widget head -->

						<div class="widget-content">				
							<span class="title">Position: </span>
							<span editable-text="categorie.position" e-name="categorie.position" e-required onbeforesave="isInteger($data)" onaftersave="changeCategoriePosition(categorie.id,categorie.position)">{{ categorie.position || 'empty' }}</span>
							<div ng-if="categorie.content" editable-textarea="categorie.content" e-form="contentBtnForm" e-rows="7" e-cols="50"  onaftersave="changeCategorieContent(categorie.id,categorie.content)">
							<pre>{{ categorie.content }}</pre>
							</div>
							<div ng-if="!categorie.content">
								<ul ng-repeat="categorie2 in categorie.categories" class="listeCategories">
									<a class="categorie"><li ng-click="getCategorie(categorie2.id); editableForm.$cancel()">{{categorie2.name}}</li></a>
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
				</select><br/>
			</div> <!-- /controls -->				
		</div>
		
		<div class="control-group">											
			<label class="control-label" for="position">Position</label>
			<div class="controls">
				<input type="text" class="span5" id="position" ng-model="position">
			</div> <!-- /controls -->				
		</div>

	</div>
	<div class="modal-footer">
		<button class="btn btn-primary" ng-click="addCategory(name,content,parent,position);">Save</button>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
	</div>
</div>


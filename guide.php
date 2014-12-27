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
								<a><li ng-click="getCategorie(categorie.id)">{{categorie.name}}</li></a>
								<ul ng-repeat="categorie2 in categorie.categories">
									<a><li ng-click="getCategorie(categorie2.id)">{{categorie2.name}}</li></a>
									<ul ng-repeat="categorie3 in categorie2.categories">
										<a><li ng-click="getCategorie(categorie3.id)">{{categorie3.name}}</li></a>
									<ul>
								<ul>
							</ul> 
						</div>
					</div>
				</div>
				<div class="span6">
					<div class="widget">
						<div class="widget-header"> 
							<i class="icon-book"></i>
							<h3> {{ categorie.name }} </h3>
						</div>
						<div class="widget-content">	
							<div ng-if="categorie.content">
							{{ categorie.content }}
							</div>
							<div ng-if="!categorie.content">
								<ul ng-repeat="categorie2 in categorie.categories">
									<a><li ng-click="getCategorie(categorie2.id)">{{categorie2.name}}</li></a>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

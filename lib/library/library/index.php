<html>
<head>
<meta charset="utf-8">
<title>Library Management</title>
	
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css">
 
<link rel="stylesheet" href="http://bootsnipp.com/dist/bootsnipp.min.css?ver=70eabcd8097cd299e1ba8efe436992b7">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">


<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.4/angular.min.js"></script>
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>

<style type="text/css">
	.pagetable th{
		background:#459BE4;
		text-align:center;
		border-color:#2D7DC0 !important;
		color:#fff;
		text-shadow:0 1px 1px rgba(0,0,0,0.45);
	}
	
	.pagetable td:last-child, .pagetable td:nth-last-child(2){
		text-align:center;
	}
	
	.control-group input[type="radio"]{
		position:relative;
		    margin-left: 0;
	}
	
</style>

</head>
<body  ng-app="libApp" >
<div class="container" ng-controller="libCntrl">
	<div class="form table-responsive" ng-show="addbook">
	<form class="" id="admin_panel_lib" role="form" method="post" novalidate>
	<fieldset>

	<!-- Form Name -->
	<legend>Library Admin Panel</legend>

	<!-- Text input-->
	<div class="control-group  form-group col-sm-4">
	  <label class="control-label" for="book_name">Name of Book</label>
	  <div class="controls">
		<input id="book_name" ng-model="book_name" ng-change="makeFieldValid('book_name')" name="book_name" type="text" placeholder="Name of Book" class="input-large form-control" required="">
		
	  </div>
	</div>

	<!-- Text input-->
	<div class="control-group  form-group col-sm-4">
	  <label class="control-label" for="author_name">Author Name</label>
	  <div class="controls">
		<input id="author_name" ng-model="author_name" name="author_name" ng-change="makeFieldValid('author_name')" type="text" placeholder="Author Name" class="input-large form-control" required="">
		
	  </div>
	</div>

	<!-- Select Basic -->
	<div class="control-group form-group col-sm-4">
	  <label class="control-label" for="department_name">Department</label>
	  <div class="controls">
		<select id="department_name" ng-model="department_name" ng-change="makeFieldValid('department_name')" name="department_name" class="input-large form-control">
		  <option value="">Select Department</option>
		  <option value="physics">Physics</option>
		  <option value="bio">Biology</option>
		  <option value="chemistry">Chemistry</option>
		  <option value="ca">Computer Applications</option>
		  <option value="sd">Software Development</option>
		</select>
	  </div>
	</div>

	<!-- Multiple Radios (inline) -->
	<div class="control-group col-sm-12">
	  <label class="control-label" for="in_stock">Available in Stock</label>
	  <div class="controls row">
		<div class="col-xs-2">
        	<label class="radio inline"  for="in_stock-0">
		  <input type="radio" name="in_stock" ng-model="in_stock" id="in_stock-0" value="yes">
		  Yes
		</label>
        </div>
		<div class="col-xs-2">
        	<label class="radio inline" for="in_stock-1">
		  <input type="radio" name="in_stock" ng-model="in_stock" id="in_stock-1" value="no">
		  No
		</label>
        </div>
	  </div>
	</div>
	<input type="hidden" id="add_cntrl" value="../library/add-controller.php"/>
	
	<!-- Button (Double) -->
	<div class="control-group">
	  <label class="control-label" for="add_book"></label>
	  <div class="controls">
		<button id="add_book" ng-click="add_book()" name="add_book" class="btn btn-primary">Add Book</button>
		<button id="view_library" ng-click="list_of_books()" name="view_library" class="btn btn-success">View Library</button>
	  </div>
	</div>
	<div class="control-group">
		<span id="msg"></span>
	</div>
	</fieldset>
	</form>
	
</div>
<div class="container" ng-show="listbook">
	<div class="container">
		<table border="1" class="table table-bordered table-hover pagetable">
			<tr>
				<th align="center">Sr.No</th>
				<th align="center">Book Name</th>
				<th align="center">Author Name</th>
				<th align="center">Department</th>
				<th align="center">Avalable In Stock?</th>
				<th align="center" colspan="2">Action</th>
			</tr>
            
           <tr ng-repeat="book in bookList">
				<td>{{book.id}}</td>
				<td>{{book.book}}</td>
				<td>{{book.author}}</td>
				<td>{{book.dept}}</td>
				<td>{{book.stock}}</td>
				<td><button id="edit_book_{{book.id}}" ng-click="edit_book(book)" name="edit_book" class="btn btn-info">Edit Book</button></td>
				<td><button id="remove_book_{{book.id}}" ng-click="remove_book(book)" data-id="{{book.id}}" name="remove_book" class="btn btn-danger">Remove Book</button></td>
			</tr>
            
			 
            
		</table> 
	</div>
	
	
</div>
<div class="container" ng-show="editBook">
  <div class="form table-responsive">
	<form class="" id="edit_panel_lib"  method="post" novalidate>
	<fieldset>

	<!-- Form Name -->
	<legend>Library Admin Panel</legend>

	<!-- Text input-->
	<div class="control-group form-group col-sm-4">
	  <label class="control-label" for="edit_book_name">Name of Book</label>
	  <div class="controls">
		<input id="edit_book_name" ng-model="edit_book_name" ng-change="makeFieldValid('edit_book_name')" value="" name="edit_book_name" type="text" placeholder="Name of Book" class="input-large form-control" required="">
		
	  </div>
	</div>

	<!-- Text input-->
	<div class="control-group form-group col-sm-4">
	  <label class="control-label" for="edit_author_name">Author Name</label>
	  <div class="controls">
		<input id="edit_author_name" ng-model="edit_author_name" name="edit_author_name" ng-change="makeFieldValid('edit_author_name')" type="text" placeholder="Author Name" class="input-large form-control" required="">
		
	  </div>
	</div>

	<!-- Select Basic -->
	<div class="control-group form-group col-sm-4">
	  <label class="control-label" for="edit_department_name">Department</label>
	  <div class="controls">
		<select id="edit_department_name" ng-model="edit_department_name" ng-change="makeFieldValid('edit_department_name')" name="department_name" class="input-large form-control">
		  <option value="">Select Department</option>
		  <option value="physics">Physics</option>
		  <option value="bio">Biology</option>
		  <option value="chemistry">Chemistry</option>
		  <option value="ca">Computer Applications</option>
		  <option value="sd">Software Development</option>
		</select>
	  </div>
	</div>

	<!-- Multiple Radios (inline) -->
	<div class="control-group form-group col-sm-12">
	  <label class="control-label" for="edit_in_stock">Available in Stock</label>
	  <div class="controls">
		
        <div class="col-sm-2">
        	<label class="radio inline"  for="edit_in_stock-0">
		  <input type="radio" name="edit_in_stock" ng-model="edit_in_stock" id="edit_in_stock-0" value="yes">
		  Yes
		</label>
        </div>
        <div class="col-sm-2">
		<label class="radio inline" for="edit_in_stock-1">
		  <input type="radio" name="edit_in_stock" ng-model="edit_in_stock" id="edit_in_stock-1" value="no">
		  No
		</label>
        </div>
	  </div>
	</div>
	<input type="hidden" id="edit_cntrl" value="../library/update-controller.php"/>
	
	<!-- Button (Double) -->
	<div class="control-group">
	  <label class="control-label" for="update_book"></label>
	  <div class="controls" >
		<button id="update_book" ng-click="update_book()" name="update_book" class="btn btn-primary">Update Book</button>
		<button id="view_library" ng-click="list_of_books()" name="view_library" class="btn btn-success">View Library</button>
	  </div>
	</div>
	<div class="control-group">
		<span id="upmsg"></span>
	</div>
	</fieldset>
	</form>
   </div> 
</div>
</div>
<script src="js/library.js"></script>
</body>
</html>
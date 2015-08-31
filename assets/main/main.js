var app = angular.module('libApp', []);
app.controller('libCntrl', function($scope, $timeout, $http){
	
	$scope.book_name		= '';
	$scope.author_name		= '';
	$scope.department_name	= '';
	$scope.in_stock			= 'yes';
	$scope.listbook			= false;
	$scope.addbook			= true;
	$scope.editBook			= false;
	$scope.bookList			= [];
	
	$scope.edit_book_name 		= '';
	$scope.edit_author_name 	= '';
	$scope.edit_department_name = '';
	$scope.edit_in_stock 		= '';
	$scope.update_bookId		= '';
	$scope.bookDetail 			= [];
	
 /* 
 * makeFieldValid will check the input gives in input box is valid or not  
 */
	
	$scope.makeFieldValid = function(arg){
		if(arg == 'book_name'){
			if($scope.book_name.length != ''){
				$("#book_name").css('border', '');
			}
		}else if(arg == 'author_name'){
			if($scope.author_name.length != ''){
				$("#author_name").css('border', '');
			}
		}else if(arg == 'department_name'){
			if($scope.department_name.length != ''){
				$("#department_name").css('border', '');
			}
		}else if(arg == 'edit_book_name'){
			if($scope.edit_book_name.length != ''){
				$("#edit_book_name").css('border', '');
			}
		}else if(arg == 'edit_author_name'){
			if($scope.edit_author_name.length != ''){
				$("#edit_author_name").css('border', '');
			}
		}else if(arg == 'edit_department_name'){
			if($scope.edit_department_name.length != ''){
				$("#edit_department_name").css('border', '');
			}
		}
	};
	
 /*  
 
  *Adding new book to the library database   
  */
	
	$scope.add_book = function(){
		if($scope.book_name.length == ''){
			$("#book_name").css('border', '2px solid red');
			$("#book_name").focus();
		}else if($scope.author_name.length == ''){
			$("#author_name").css('border', '2px solid red');
			$("#author_name").focus();
		}else if($scope.department_name.length == ''){
			$("#department_name").css('border', '2px solid red');
			$("#department_name").focus();
		}else{
			var bookData = $("#admin_panel_lib").serializeArray();
			var addUrl = $("#add_cntrl").val();
			
			$.ajax({
				type : "POST",
				url	 : addUrl,
				dataType: "json",
				data : bookData,
				success : function(data){
					if(data.R == 1){
						$("#msg").html("<b style='color:green;'>"+data.M+"</b>");
						$timeout(function(){$("#msg").html('');},3000);
					}else{
						$("#msg").html("<b style='color:red;'>"+data.M+"</b>");
						$timeout(function(){$("#msg").html('');},3000);
					}
				}
			});
		}
	};
	
	/* // view all existing books in database   */
	
	$scope.list_of_books = function(){
		
		$scope.listbook	= true;
		$scope.addbook	= false;
		$scope.editBook	= false;
		var viewUrl		= "../angulargulpcrud/view-controller.php";
		var list = '';
		
		$http.get(viewUrl).success(function(data){
			$scope.bookList = [];
			$.each(data, function(index, value){
				
				$scope.bookList.push({
					'id'	:	value.book_id,
					'book'	:	value.book_name,
					'author':	value.author_name,
					'dept'	:	value.department,
					'stock'	:	value.in_stock
				});
			});
		});
	};
	
	/* // removing book from the library database  */
	
	$scope.remove_book = function(book){
		var r = confirm("Are you sure want to delete this book?");
		var dltUrl = '../angulargulpcrud/delete-controller.php';
		if(r == true){
			$http({
				method:'post',
				url : dltUrl,
				dataType:'json',
				data : $.param({'id': book.id}),
				headers: {'Content-Type': 'application/x-www-form-urlencoded'}
			}).success(function(data){
				if(data.R == 1){
					alert(data.M);
					var index = $scope.bookList.indexOf(book);
					$scope.bookList.splice(index, 1);
				}
			});
		}
	};
	
	/* // editing the book details of existing library database */
	
	$scope.edit_book = function(book){
		$scope.editBook = true;
		$scope.listbook = false;
		$scope.bookDetail = {};
		/* //console.log(book); */
		$scope.bookDetail = {
			'name' : book.book,
			'author': book.author,
			'dept'	: book.dept,
			'stock'	: book.stock,
			'bookid': book.id
		};
		$scope.edit_book_name 		= $scope.bookDetail.name;
		$scope.edit_author_name 	= $scope.bookDetail.author;
		$scope.edit_department_name = $scope.bookDetail.dept;
		$scope.edit_in_stock 		= $scope.bookDetail.stock;
		$scope.update_bookId		= $scope.bookDetail.bookid;
	};
	
	/* // update the book details to the library   */
	
	$scope.update_book = function(){
		if($scope.edit_book_name.length == ''){
			$("#edit_book_name").css('border', '2px solid red');
			$("#edit_book_name").focus();
		}else if($scope.edit_author_name.length == ''){
			$("#edit_author_name").css('border', '2px solid red');
			$("#edit_author_name").focus();
		}else if($scope.edit_department_name.length == ''){
			$("#edit_department_name").css('border', '2px solid red');
			$("#edit_department_name").focus();
		}else{
			var updtUrl = $("#edit_cntrl").val();
			var updateData = $("#edit_panel_lib").serializeArray();
			
			$http({
				method : "post",
				url : updtUrl,
				dataType: 'json',
				data : "book_name="+$scope.edit_book_name+"&author="+$scope.edit_author_name+"&dept="+$scope.edit_department_name+"&stock="+$scope.edit_in_stock+"&id="+$scope.update_bookId,
				headers: {'Content-Type': 'application/x-www-form-urlencoded'}
			}).success(function(data){
				if(data.R == 1){
					$("#upmsg").html("<b style='color:green;'>"+data.M+"</b>");
					$timeout(function(){$("#upmsg").html('');},3000);
				}else{
					$("#upmsg").html("<b style='color:red;'>"+data.M+"</b>");
					$timeout(function(){$("#upmsg").html('');},3000);
				}
			});
		}
	}
});

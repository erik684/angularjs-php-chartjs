app.controller("headerCtrl", function ($scope, user) {
	$scope.userView = user.getUserView();
	$scope.$watch('user', function (new, old) {
		console.log($scope.userView);
	});
	
});
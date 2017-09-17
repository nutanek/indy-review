var theme = angular.module('indyReview', ['masonry']);

theme.run(function ($rootScope) {
        $rootScope.indyConfig = indyConfig;
    })
    .controller('header', ['$scope', '$rootScope', '$timeout', '$http', 'ratingServices', 
                function ($scope, $rootScope, $timeout, $http, ratingServices) {
            // ratingServices.get(32).then(function(data) {
            //     console.log("11111", data);
            // }, function(err) {
            //     console.log("11111", err);
            // });

            // ratingServices.getAvg(32).then(function(data) {
            //     console.log("111qqq11", data);
            // }, function(err) {
            //     console.log("11qqq111", err);
            // });
    }])
    .controller('article', ['$scope', '$timeout', function ($scope, $timeout) {
        var wrap = function (el, wrapper) {
            el.parentNode.insertBefore(wrapper, el);
            wrapper.appendChild(el);
        }
        angular.forEach(angular.element(document.querySelectorAll('.article__content img')), function (value, key) {
            var img = angular.element(value);
            if (img[0].classList.value.indexOf("aligncenter") !== -1) {
                img[0].style.marginLeft = "auto";
                img[0].style.marginRight = "auto";
            } else if (img[0].classList.value.indexOf("alignright") !== -1) {
                img[0].style.marginLeft = "auto";
            }
            img.addClass('img-responsive');
        });

        angular.forEach(angular.element(document.querySelectorAll('.article__content div[id^=attachment]')), function (value, key) {
            var attachment = angular.element(value);
            attachment[0].style.width = "";
        });

        angular.forEach(angular.element(document.querySelectorAll('embed, iframe')), function (value, key) {
            var iframe = angular.element(value);
            var responsiveIframe = document.createElement('div');
            responsiveIframe.className = "video-wrapper";
            wrap(value, responsiveIframe);
        });

    }])
    .controller('postRating', ['$scope', '$rootScope', '$timeout', 'ratingServices', function ($scope, $rootScope, $timeout, ratingServices) {
        /******************* Declarations *******************/ 
        var lang = $rootScope.indyConfig.lang;
        $scope.lang = lang == 'th' || lang == 'th_TH' ? 'th' : 'en';
        $scope.selecting = false;
        $scope.ratingAvg = -1;
        $scope.currentEmo = 2;
        $scope.closing = false;
        $scope.emotion = [
            { img: '1.svg', title: { en: 'Terrible', th: 'แย่มาก' }, score: 1 },
            { img: '2.svg', title: { en: 'Bad', th: 'แย่' }, score: 2 },
            { img: '3.svg', title: { en: 'Okay', th: 'เฉยๆ' }, score: 3 },
            { img: '4.svg', title: { en: 'Good', th: 'ดี' }, score: 4 },
            { img: '5.svg', title: { en: 'Great', th: 'สุดยอด' }, score: 5 }
        ];
        var updateEmo = function() {
            var emo = Math.abs(Math.round(($scope.ratingAvg-1)/2));
            emo = emo == 5 ? 4 : emo;
            $scope.currentEmo = emo;
        }
        /******************* Loading Data *******************/ 
        ratingServices.getAvg($scope.postID).then(function(data) {
            $scope.ratingAvg = data.avg;
            updateEmo();
        }, function(err) {
            // do noting
        });
        /******************* Functions *******************/ 
        $scope.isSelect = function() {
            $scope.selecting = true;
            $('[data-toggle="tooltip"]').tooltip();
        }
        $scope.notSelect = function() {
            $scope.selecting = false;
        }
        $scope.pushRating = function(score) {
            ratingServices.push($scope.postID, score).then(function(data) {
                if (!data.result) {
                    $scope.ratingAvg = data.data.avg
                    updateEmo();
                }
            }, function() {
                // do noting
            });
            $(".tooltip").hide();
            $scope.closing = true;
            $timeout(function() {
                $scope.selecting = false;
                $scope.closing = false;
            }, 200);
        }
    }])
    .controller('postsController', ['$scope', '$rootScope', '$timeout', '$compile', '$element', 'postsServices', 
            function ($scope, $rootScope, $timeout, $compile, $element, postsServices) {
        var currentPage = 1;
        var category = 'all';
        var orderBy = 'new';
        $scope.isLoading = false;
        $scope.showLoadMore = true;
        $scope.showContent = true;

        $scope.loadMore = function() {
            currentPage++;
            $scope.isLoading = true;
            postsServices.get(category, orderBy, currentPage).then(function(posts) {
                $scope.showContent = true; 
                if (!posts.result) {
                    var newScope = $scope.$new(true);
                    newScope.posts = posts.data;
                    var el = $compile("<post-item ng-repeat='post in posts' options='post'></post-item>")(newScope);
                    $element.find('.posts__body').append(el);
                    $timeout(function() {
                        $scope.isLoading = false;                              
                    }, 1000);
                } else {
                    $scope.isLoading = false;  
                    $scope.showLoadMore = false;
                }
            }, function() {
                $scope.isLoading = false;
                $scope.showContent = true;  
            });
        };

        $scope.sortBy = function(option) {
            if (option == 2) {
                orderBy = 'score';
            } else {
                orderBy = 'new';                
            }
            currentPage = 0;
            $scope.isLoading = true;
            $scope.showContent = false;
            $scope.showLoadMore = true;
            $element.find('.posts__body').empty();
            $scope.loadMore();
        };
    }])
    .controller('postItem', ['$scope', '$rootScope', '$timeout', function ($scope, $rootScope, $timeout) {
        // console.log($scope.options);
    }])
    .controller('sortSelector', ['$scope', '$rootScope', function ($scope, $rootScope) {
        var lang = $rootScope.indyConfig.lang;
        $scope.lang = lang == 'th' || lang == 'th_TH' ? 'th' : 'en';
        $scope.currentOption = 1;
        $scope.text = {
            lastest: {
                en: 'Lastest',
                th: 'ใหม่ล่าสุด'
            },
            top_score: {
                en: 'Top Score',
                th: 'คะแนนสูงสุด'
            },
            sort_by: {
                en: 'sort by',
                th: 'เรียงตาม'
            }
        }

        $scope.select = function(option) {
            $scope.currentOption = option;
            $scope.sortBy({
                option: option
            });
        };
    }]);


theme.filter('reverse', function() {
    return function(items) {
        return items.slice().reverse();
    };
})
.filter('html', function($sce){
    return function(input){
        return $sce.trustAsHtml(input);
    }
});
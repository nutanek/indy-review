var theme = angular.module('indyReview', ['masonry', 'ngCookies']);

theme.run(function ($rootScope) {
        $rootScope.indyConfig = indyConfig;
    })
    .config(['$cookiesProvider', function($cookiesProvider) {
        // Set $cookies defaults
        $cookiesProvider.defaults.path = '/'; 
        // $cookiesProvider.defaults.secure = true;
        // $cookiesProvider.defaults.expires = exp_date;
        // $cookiesProvider.defaults.domain = 'https://www.indytheme.com';
    }])
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
            img.addClass('img-fluid');
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
        var lang = $rootScope.indyConfig.lang == 'th' || lang == 'th_TH' ? 'th' : 'en';
        $scope.selecting = false;
        $scope.ratingAvg = -1;
        $scope.currentEmo = 2;
        $scope.closing = false;
        $scope.emotion = [
            { img: '1.svg', title: locale[lang].__rating_terrible , score: 1 },
            { img: '2.svg', title: locale[lang].__rating_bad, score: 2 },
            { img: '3.svg', title: locale[lang].__rating_okay, score: 3 },
            { img: '4.svg', title: locale[lang].__rating_good, score: 4 },
            { img: '5.svg', title: locale[lang].__rating_great, score: 5 }
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
            var options = {
                catID: $scope.extension.catID || category, 
                orderBy: orderBy, 
                page: currentPage,
                tag: $scope.extension.tag || undefined,
                search: $scope.extension.search || undefined
            };
            // console.log(options)
            postsServices.get(options).then(function(posts) {
                $scope.showContent = true; 
                console.log(posts)
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
        var lang = $rootScope.indyConfig.lang == 'th' || lang == 'th_TH' ? 'th' : 'en';
        $scope.currentOption = 1;
        $scope.text = {
            lastest: locale[lang].__sort_lastest,
            top_score: locale[lang].__sort_top_score,
            sort_by: locale[lang].__sort_sort_by
        }

        $scope.select = function(option) {
            $scope.currentOption = option;
            $scope.sortBy({
                option: option
            });
        };
    }])
    .controller('contentRating', ['$scope', '$rootScope', 'ratingServices', '$cookies', 
        function ($scope, $rootScope, ratingServices, $cookies) {
        var lang = $rootScope.indyConfig.lang == 'th' || lang == 'th_TH' ? 'th' : 'en';
        $scope.emotion = [
            { img: '1.svg', title: locale[lang].__rating_terrible , score: 1, color: '#e74c3c' },
            { img: '2.svg', title: locale[lang].__rating_bad, score: 2, color: '#e67e22' },
            { img: '3.svg', title: locale[lang].__rating_okay, score: 3, color: '#f1c40f' },
            { img: '4.svg', title: locale[lang].__rating_good, score: 4, color: '#2ecc71' },
            { img: '5.svg', title: locale[lang].__rating_great, score: 5, color: '#3498db' }
        ];
        $scope.numVoters = 0;
        $scope.ratingAvg = 0;

        console.log("$cookieStore.get('obj')", $cookies.getObject('indy_review'))
        
        var getRatingScore = function() {
            ratingServices.get($scope.postId).then(function(data) {
                if (!data.result) {
                    data.rating.map(function(score, index) {
                        $scope.emotion[index].rating = score;
                    });
                    $scope.numVoters = data.rating.reduce(function(total, num) {
                        return total + num; 
                    });
                }
                console.log($scope.emotion)
            }, function(err) {
                // do noting
            });
        };

        var getRatingAvg = function() {
            ratingServices.getAvg($scope.postId).then(function(data) {
                if (!data.result) {
                    $scope.ratingAvg = data.avg;
                }
            }, function(err) {
                // do noting
            });
        };

        getRatingScore();
        getRatingAvg();

        $scope.bindingTooltip = function() {
            $('[data-toggle="tooltip"]').tooltip();   
        };

        $scope.pushRating = function(score) {
            ratingServices.push($scope.postId, score).then(function(data) {
                if (!data.result) {
                    var someSessionObj = 1;
                    var posts = $cookies.getObject('indy_review') || [];
                    posts.push($scope.postId);
                    $cookies.putObject('indy_review', posts, { path: '/'});

                    $scope.ratingAvg = data.data.avg
                    getRatingScore();
                }
            }, function() {
                // do noting
            });
        };
    }])
    .controller('contentRatingItem', ['$scope', '$rootScope', '$timeout', function ($scope, $rootScope, $timeout) {
        
        $scope.isSelect = function() {
             $('[data-toggle="tooltip"]').tooltip();           
        };
        
        $scope.vote = function() {
            console.log('ssssssssss')
            $scope.pushRating({
                score: $scope.emo.score
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
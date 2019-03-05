'use strict';
var visualizerApp = angular.module('app', ['ui.bootstrap', 'angular-inview', 'oc.lazyLoad']);

visualizerApp.config(['$locationProvider', function ($locationProvider) {
    $locationProvider.html5Mode(true).hashPrefix();
}]);
visualizerApp.controller('visualizerCtrl',
    ['$scope', '$window', '$filter', '$uibModal', '$location', '$http', '$anchorScroll',
    function ($scope, $window, $filter, $uibModal, $location) {

        $scope.index = 1;
        $scope.params = $location.search();
       
        var BacksplashResetUrl = "/glass-mosaics/adara-interlocking-8mm/";
        var BackSplashResetName = "Adara Interlocking 8MM";
       
        $scope.accordion = { Kitchen: true };
        // $scope.baseURL = 'https://cdn.msistone.com/images/virtual-kitchen-designer/';
        $scope.baseURL = 'VisualizerResponsive/images/';

        $scope.sources = {};

        $scope.canvas = document.getElementById('myCanvas');

        $scope.context = $scope.canvas.getContext('2d');


        $scope.canvas2 = document.getElementById('myCanvas2');
        $scope.context2 = $scope.canvas2.getContext('2d');

        $scope.images = [];

        $scope.images2 = [];

        $scope.logoWaterMark = new Image();
        $scope.logoWaterMark.src = $scope.baseURL + "msilogo.png"

        $scope.imgHeight = 0;
        $scope.imgWidth = 0;

        $scope.initOptions = function (Options) {
            $scope.Options = Options;
            $scope.Reset();
        };

        $scope.setSource = function () {
          
            $scope.sources = {
                base: $scope.baseURL + $scope.Kitchen.BaseImg,
                countertop: $scope.baseURL + $scope.Kitchen.Folder + '/' + $scope.CounterTop.Img,
                backsplash: $scope.baseURL + $scope.Kitchen.Folder + '/' + $scope.BackSplash.Img,
                cabinet: $scope.baseURL + $scope.Kitchen.Folder + '/' + $scope.CabinetColor.Img,
                floor: $scope.baseURL + $scope.Kitchen.Folder + '/' + $scope.Floor.Img
            };
            if ($scope.Kitchen.Folder !="Kitchen1") {

                $scope.Kitchen2 = { "Folder": "kitchen52", "Type": ["k5"], BaseImg: "kitchen52base.jpg" };
            }
            else {

                $scope.Kitchen2 = { "Folder": "kitchen2", "Type": ["k1"], BaseImg: "kitchen2base.png" };
            }
            $scope.sources2 = {
                base: $scope.baseURL + $scope.Kitchen2.BaseImg,
                countertop: $scope.baseURL + $scope.Kitchen2.Folder + '/' + $scope.CounterTop.Img,
                backsplash: $scope.baseURL + $scope.Kitchen2.Folder + '/' + $scope.BackSplash.Img,
                cabinet: $scope.baseURL + $scope.Kitchen2.Folder + '/' + $scope.CabinetColor.Img
            }
        };
        $scope.Reset = function () {
            var CounterTopId = 105;
            var BacksplashId = 352;
            var FloorId = 89;
            var kitchenType
            $scope.currentPage = 1;

            $scope.Kitchen = { "Folder": "kitchen51", "Type": ["k5"], BaseImg: "kitchen51base.jpg" };

            $scope.Kitchen2 = { "Folder": "kitchen52", "Type": ["k5"], BaseImg: "kitchen52base.jpg" };

            kitchenType = $filter("filter")($scope.Options.CounterTops, { ID: CounterTopId })[0];
            if ($scope.params != undefined && $scope.params.cntps != undefined) {
                // t= Countertop ; f= floor; p = backsplash
                var selection = $scope.params.cntps.substring(0, 1).toUpperCase();

                switch (selection) {
                    case "T":
                        CounterTopId = parseInt($scope.params.cntps.substring(1));
                       
                        kitchenType = $filter("filter")($scope.Options.CounterTops, { ID: CounterTopId })[0];
                        break;
                    case "F":
                        FloorId = parseInt($scope.params.cntps.substring(1));
                        kitchenType = $filter("filter")($scope.Options.Floors, { ID: FloorId })[0];
                        break;
                    case "P":
                        BacksplashId = parseInt($scope.params.cntps.substring(1));
                        kitchenType = $filter("filter")($scope.Options.Backsplashs, { ID: BacksplashId })[0];
                        break;
                    default:
                        console.error("Invalid Query String", $scope.params.cntps);
                }
            }

            var tempOpt = $filter("filter")($scope.Options.CounterTops, { ID: CounterTopId });
            if (tempOpt.length == 0) {
                tempOpt = [$scope.Options.CounterTops[0]];
                console.error("Invalid Countertop Id", CounterTopId);
            }
            $scope.CounterTop = { ID: tempOpt[0].ID, Img: "VS" + ("0000" + tempOpt[0].ID).slice(-4) + "CT.PNG", URL: tempOpt[0].PageURL, Name: tempOpt[0].Name, NaturalStone: true, Quartz: true };
          

            tempOpt = $filter("filter")($scope.Options.Backsplashs, { ID: BacksplashId });
            if (tempOpt.length == 0) {
                tempOpt = [$scope.Options.Backsplashs[0]];
                console.error("Invalid Backsplash Id", BacksplashId);
            }
            $scope.BackSplash = { ID: tempOpt[0].ID, Img: "VS" + ("0000" + tempOpt[0].ID).slice(-4) + "BL.PNG", URL: tempOpt[0].PageURL, Name: tempOpt[0].Name };

            tempOpt = $filter("filter")($scope.Options.Cabinets, { ID: 5 });
            if (tempOpt.length == 0) {
                tempOpt = [$scope.Options.Cabinets[0]];
                console.error("Invalid Cabinets Id", 5);
            }
            $scope.CabinetColor = { ID: tempOpt[0].ID, Img: "VS" + ("0000" + tempOpt[0].ID).slice(-4) + "CB.PNG", Name: tempOpt[0].Name };

            tempOpt = $filter("filter")($scope.Options.Floors, { ID: FloorId });
            if (tempOpt.length == 0) {
                tempOpt = [$scope.Options.Floors[0]];
                console.error("Invalid Floor Id", FloorId);
            }
            $scope.Floor = { ID: tempOpt[0].ID, Img: "VS" + ("0000" + tempOpt[0].ID).slice(-4) + "FL.PNG", URL: tempOpt[0].PageURL, Name: tempOpt[0].Name };

            $scope.CTASBL = false;

            // select Kitchen based on Query string
            if (kitchenType == undefined) {
                $scope.currentPage = 1;
                $scope.SelectKitchen(0);
            }
            else if (kitchenType.KitchenGroup.toUpperCase().indexOf("K5") >= 0) {
                $scope.currentPage = 1;
                $scope.SelectKitchen(0);
              
            }
            else if (kitchenType.KitchenGroup.toUpperCase().indexOf("K1") >= 0) {
                $scope.currentPage = 2;
                $scope.SelectKitchen(1);
               
            }
            else {
                $scope.currentPage = 1;
                $scope.SelectKitchen(0);
            }
            // $scope.setSource();
        };
        $scope.loadImages = function (images, sources, callback) {
            // var images = {};
            var loadedImages = 0;
            var numImages = 0;
            // get num of sources
            for (var src in sources) {
                numImages++;

            }

            for (var src in sources) {
                images[src] = new Image();
                images[src].class = "img-responsiveHeight";
                images[src].onload = function () {
                    //console.log(loadedImages);
                    if (++loadedImages >= numImages) {
                        callback(images);
                    }
                };
                images[src].onerror = function () {
                    //++loadedImages;in-view
                    console.error("Image Not found for " + src + ", URL : " + images[src].src);
                    //images[src] = undefined;
                    if (++loadedImages >= numImages) {
                        callback(images);
                    }
                };
                images[src].src = sources[src];

              
            }
        };

        $scope.ElementInView = function (index, inview, eleName) {
            var img = angular.element(document.getElementById(eleName + "[" + index + "]"));
          
            
            if (inview) {
                img.attr('src', img.attr("smart-src"));
                 
            }
        };

        $scope.SelectKitchen = function (kitchenIndex) {
           
            $scope.index = kitchenIndex;

            $scope.ChangeKitchen({ "Folder": $scope.Options.VisualizerTypes[kitchenIndex].folder, "Type": [$scope.Options.VisualizerTypes[kitchenIndex].TypeOfVisualizer], "BaseImg": $scope.Options.VisualizerTypes[kitchenIndex].BaseImg, "SecondView": false });

        };

        $scope.ChangeCT = function (ct) {

            $scope.CounterTop.ID = ct.ID;
            $scope.CounterTop.URL = ct.PageURL;
            $scope.CounterTop.Name = ct.Name;
            $scope.CounterTop.Img = "VS" + ("0000" + ct.ID).slice(-4) + "CT.png";
            $scope.images.countertop.src = $scope.baseURL + $scope.Kitchen.Folder + '/' + $scope.CounterTop.Img;

            $scope.images2.countertop.src = $scope.baseURL + $scope.Kitchen2.Folder + '/' + $scope.CounterTop.Img;

            if ($scope.BackSplash.CTASBL) {
                $scope.BackSplash.URL = ct.PageURL;
                $scope.BackSplash.Name = ct.Name;
                // $scope.BackSplash.ImgAsCt = "CTasBL-" + $scope.Kitchen.Type[0] + "/VS" + ("0000" + ct.ID).slice(-4) + "BL.png";
                $scope.images.backsplash.src = $scope.baseURL + $scope.Kitchen.Folder + "/VS" + ("0000" + $scope.CounterTop.ID).slice(-4) + "BC.png";
                $scope.images2.backsplash.src = $scope.baseURL + $scope.Kitchen2.Folder + "/VS" + ("0000" + $scope.CounterTop.ID).slice(-4) + "BC.png";

            }
            $scope.LogKitchen("Countertop", $scope.CounterTop.Name);

            if (parent == window) {
                document.getElementById('lblHeading').scrollIntoView({
                    behavior: "smooth",
                    block: "start",
                });
            }
        };

        $scope.ChangeBL = function (bl) {
        
            $scope.BackSplash.CTASBL = false;
            $scope.BackSplash.ID = bl.ID;
            $scope.BackSplash.URL = bl.PageURL;          
            $scope.BackSplash.Name = bl.Name;
           BacksplashResetUrl = bl.PageURL;
           BackSplashResetName = bl.Name;
           
            $scope.BackSplash.Img = "VS" + ("0000" + bl.ID).slice(-4) + "BL.png";
            $scope.images.backsplash.src = $scope.baseURL + $scope.Kitchen.Folder + '/' + $scope.BackSplash.Img;
            $scope.images2.backsplash.src = $scope.baseURL + $scope.Kitchen2.Folder + '/' + $scope.BackSplash.Img;
            $scope.LogKitchen("BackSplash", $scope.BackSplash.Name);
            if (parent == window) {
                document.getElementById('lblHeading').scrollIntoView({
                    behavior: "smooth",
                    block: "start",
                });
            }
        };

        $scope.ChangeCB = function (cb) {
            $scope.CabinetColor.ID = cb.ID;
            $scope.CabinetColor.Name = cb.Name
            $scope.CabinetColor.Img = "VS" + ("0000" + cb.ID).slice(-4) + "CB.png";
            $scope.images.cabinet.src = $scope.baseURL + $scope.Kitchen.Folder + '/' + $scope.CabinetColor.Img;
            $scope.images2.cabinet.src = $scope.baseURL + $scope.Kitchen2.Folder + '/' + $scope.CabinetColor.Img;
            $scope.LogKitchen("Cabinet", $scope.CabinetColor.Name);
            if (parent == window) {
                document.getElementById('lblHeading').scrollIntoView({
                    behavior: "smooth",
                    block: "start",
                });
            }
        };

        $scope.ChangeFL = function (fl) {
            $scope.Floor.ID = fl.ID;
            $scope.Floor.URL = fl.PageURL;
            $scope.Floor.Name = fl.Name
            $scope.Floor.Img = "VS" + ("0000" + fl.ID).slice(-4) + "FL.png";
            $scope.images.floor.src = $scope.baseURL + $scope.Kitchen.Folder + '/' + $scope.Floor.Img;
            $scope.LogKitchen("Floor", $scope.Floor.Name);
            if (parent == window) {
                document.getElementById('lblHeading').scrollIntoView({
                    behavior: "smooth",
                    block: "start",
                });
            }

        };
    //use countertop for backsplah section //
        $scope.setBL_As_CT = function () {
            
            if ($scope.BackSplash.CTASBL) {
                $scope.BackSplash.URL = $scope.CounterTop.URL;
                $scope.BackSplash.Name = $scope.CounterTop.Name;
              
                
                $scope.images.backsplash.src = $scope.baseURL + $scope.Kitchen.Folder + "/VS" + ("0000" + $scope.CounterTop.ID).slice(-4) + "BC.png";
                $scope.images2.backsplash.src = $scope.baseURL + $scope.Kitchen2.Folder + "/VS" + ("0000" + $scope.CounterTop.ID).slice(-4) + "BC.png";
               
            }
            else {
                $scope.BackSplash.URL = BacksplashResetUrl;
                $scope.BackSplash.Name = BackSplashResetName;
            
               
                $scope.images.backsplash.src = $scope.baseURL + $scope.Kitchen.Folder + "/VS" + ("0000" + $scope.BackSplash.ID).slice(-4) + "BL.png";
                $scope.images2.backsplash.src = $scope.baseURL + $scope.Kitchen2.Folder + "/VS" + ("0000" + $scope.BackSplash.ID).slice(-4) + "BL.png";

            }
        };

        $scope.ChangeKitchen = function (kitchen) {
            $scope.Kitchen = kitchen;

            $scope.setSource();
            if ($scope.BackSplash.CTASBL && $scope.Kitchen.Type.join(',').indexOf('k5') < 0) {
                $scope.sources.backsplash = $scope.baseURL + $scope.Kitchen.Folder + "/VS" + ("0000" + $scope.CounterTop.ID).slice(-4) + "BC.png";
                $scope.sources2.backsplash = $scope.baseURL + $scope.Kitchen2.Folder + "/VS" + ("0000" + $scope.CounterTop.ID).slice(-4) + "BC.png";

            }
        };
        $scope.updateCanvas = function (images) {

            if ($scope.imgHeight == 0) {
                $scope.imgHeight = images.base.height;
                $scope.imgWidth = images.base.width;
            }
            $scope.canvas.height = $scope.imgHeight;
            $scope.canvas.width = $scope.imgWidth;
            $scope.context.restore();
            $scope.context.drawImage(images.base, 0, 0, $scope.imgWidth, $scope.imgHeight);
            if (images.countertop) {
                $scope.context.drawImage(images.countertop, 0, 0, $scope.imgWidth, $scope.imgHeight);
            }
            if (images.backsplash) {
                $scope.context.drawImage(images.backsplash, 0, 0, $scope.imgWidth, $scope.imgHeight);
            }
            if (images.cabinet) {
                $scope.context.drawImage(images.cabinet, 0, 0, $scope.imgWidth, $scope.imgHeight);
            }
            if (images.floor) {
                $scope.context.drawImage(images.floor, 0, 0, $scope.imgWidth, $scope.imgHeight);
            }
        };

        $scope.updateCanvas2 = function (images) {

            if ($scope.imgHeight == 0) {
                $scope.imgHeight = images.base.height;
                $scope.imgWidth = images.base.width;
            }
            $scope.canvas2.height = $scope.imgHeight;
            $scope.canvas2.width = $scope.imgWidth;
            $scope.context2.restore();

            $scope.context2.drawImage(images.base, 0, 0, $scope.imgWidth, $scope.imgHeight);
            if (images.countertop) {
                $scope.context2.drawImage(images.countertop, 0, 0, $scope.imgWidth, $scope.imgHeight);
            }
            if (images.backsplash) {
                $scope.context2.drawImage(images.backsplash, 0, 0, $scope.imgWidth, $scope.imgHeight);
            }
            if (images.cabinet) {
                $scope.context2.drawImage(images.cabinet, 0, 0, $scope.imgWidth, $scope.imgHeight);
            }
            //$scope.context2.drawImage(images.floor, 0, 0, $scope.imgWidth, $scope.imgHeight);

        };

        $scope.AddDetailsToCanvas = function (images, hideDetails) {

            hideDetails = hideDetails || false;
            var lineHeight = 16;
            if (hideDetails) {
                $scope.canvas.height = $scope.imgHeight;
            }
            else {
                $scope.canvas.height = $scope.imgHeight + (lineHeight * 5) + 10;
            }

            $scope.canvas.width = $scope.imgWidth;
            $scope.context.restore();


            $scope.context.drawImage(images.base, 0, 0, $scope.imgWidth, $scope.imgHeight);
            if (images.countertop) {
                $scope.context.drawImage(images.countertop, 0, 0, $scope.imgWidth, $scope.imgHeight);
            }
            if (images.backsplash) {
                $scope.context.drawImage(images.backsplash, 0, 0, $scope.imgWidth, $scope.imgHeight);
            }
            if (images.cabinet) {
                $scope.context.drawImage(images.cabinet, 0, 0, $scope.imgWidth, $scope.imgHeight);
            }
            if (images.floor) {
                $scope.context.drawImage(images.floor, 0, 0, $scope.imgWidth, $scope.imgHeight);
            }
            $scope.context.drawImage($scope.logoWaterMark, $scope.imgWidth - $scope.logoWaterMark.width - 10, $scope.imgHeight - $scope.logoWaterMark.height - 10);
            if (!hideDetails) {
                $scope.context.font = lineHeight + "px Arial";

                $scope.context.fillText("My Kitchen Visualizer Design", 10, $scope.imgHeight + (lineHeight * 1));

                $scope.context.fillText("Countertop", 10, $scope.imgHeight + (lineHeight * 2));
                $scope.context.fillText(": " + $scope.CounterTop.Name, 100, $scope.imgHeight + (lineHeight * 2));

                $scope.context.fillText("Backsplash", 10, $scope.imgHeight + (lineHeight * 3));
                $scope.context.fillText(": " + $scope.BackSplash.Name, 100, $scope.imgHeight + (lineHeight * 3));

                $scope.context.fillText("Cabinet", 10, $scope.imgHeight + (lineHeight * 4));
                $scope.context.fillText(": " + $scope.CabinetColor.Name, 100, $scope.imgHeight + (lineHeight * 4));

                $scope.context.fillText("Floor", 10, $scope.imgHeight + (lineHeight * 5));
                $scope.context.fillText(": " + $scope.Floor.Name, 100, $scope.imgHeight + (lineHeight * 5));
            }
        };

        $scope.AddDetailsToCanvas2 = function (images, hideDetails) {
            hideDetails = hideDetails || false;
            var lineHeight = 16;
            if (hideDetails) {
                $scope.canvas2.height = $scope.imgHeight;
            }
            else {
                $scope.canvas2.height = $scope.imgHeight + (lineHeight * 5) + 10;
            }

            $scope.canvas2.width = $scope.imgWidth;
            $scope.context2.restore();


            $scope.context2.drawImage(images.base, 0, 0, $scope.imgWidth, $scope.imgHeight);
            if (images.countertop) {
                $scope.context2.drawImage(images.countertop, 0, 0, $scope.imgWidth, $scope.imgHeight);
            }
            if (images.backsplash) {
                $scope.context2.drawImage(images.backsplash, 0, 0, $scope.imgWidth, $scope.imgHeight);
            }
            if (images.cabinet) {
                $scope.context2.drawImage(images.cabinet, 0, 0, $scope.imgWidth, $scope.imgHeight);
            }
            $scope.context2.drawImage($scope.logoWaterMark, $scope.imgWidth - $scope.logoWaterMark.width - 10, $scope.imgHeight - $scope.logoWaterMark.height - 10);

            if (!hideDetails) {

                $scope.context2.font = lineHeight + "px Arial";

                $scope.context2.fillText("My Kitchen Visualizer Design", 10, $scope.imgHeight + (lineHeight * 1));

                $scope.context2.fillText("Countertop", 10, $scope.imgHeight + (lineHeight * 2));
                $scope.context2.fillText(": " + $scope.CounterTop.Name, 100, $scope.imgHeight + (lineHeight * 2));

                $scope.context2.fillText("Backsplash", 10, $scope.imgHeight + (lineHeight * 3));
                $scope.context2.fillText(": " + $scope.BackSplash.Name, 100, $scope.imgHeight + (lineHeight * 3));

                $scope.context2.fillText("Cabinet", 10, $scope.imgHeight + (lineHeight * 4));
                $scope.context2.fillText(": " + $scope.CabinetColor.Name, 100, $scope.imgHeight + (lineHeight * 4));
            }
        };

        $scope.initCanvas = function () {
            $scope.loadImages($scope.images, $scope.sources, $scope.updateCanvas);
            $scope.loadImages($scope.images2, $scope.sources2, $scope.updateCanvas2);
        };

        $scope.getCanvasImg = function () {


            $scope.AddDetailsToCanvas($scope.images);

            $scope.canvas.toBlob(function (blob) {
                saveAs(blob, "My_Kitchen_Design.png");
            });
            $scope.updateCanvas($scope.images);

           
                $scope.AddDetailsToCanvas2($scope.images2);
                $scope.canvas2.toBlob(function (blob) {
                    saveAs(blob, "My_Kitchen_Design_2.png");
                });
                $scope.updateCanvas2($scope.images2);
            
        };

        $scope.$watch('sources', $scope.initCanvas);


        $scope.ShowOptionDiv = function (divId) {
           
            document.getElementById('divCT').classList.add("hidden-xs");
            document.getElementById('divBL').classList.add("hidden-xs");
            document.getElementById('divCB').classList.add("hidden-xs");
            document.getElementById('divFL').classList.add("hidden-xs");
            document.getElementById(divId).classList.remove("hidden-xs");

            document.getElementById('divCT_Btn').classList.remove("hidden-xs");
            document.getElementById('divBL_Btn').classList.remove("hidden-xs");
            document.getElementById('divCB_Btn').classList.remove("hidden-xs");
            document.getElementById('divFL_Btn').classList.remove("hidden-xs");
            document.getElementById(divId + '_Btn').classList.add("hidden-xs");

            document.getElementById('chkNS').classList.add("hidden-xs");
            document.getElementById('chkQ').classList.add("hidden-xs");
            document.getElementById('lblNew').classList.add("hidden-xs");

            var chkBL = document.getElementById("chk").checked;
            
            if (divId === "divCT") {
                document.getElementById('chkNS').classList.remove("hidden-xs");
                document.getElementById('chkQ').classList.remove("hidden-xs");
                document.getElementById('lblNew').classList.remove("hidden-xs");
                document.getElementById('chkBL').classList.remove("hidden-xs");
            }
            else if (divId === "divBL") {
                
                if (chkBL) {
                    document.getElementById('chkBL').classList.remove("hidden-xs");
                }
                else {
                    document.getElementById('chkBL').classList.add("hidden-xs");
                }
            }
            else if (divId === "divCB") {
                document.getElementById('chkBL').classList.add("hidden-xs");
            }
            else if (divId === "divFL") {
                document.getElementById('chkBL').classList.add("hidden-xs");
            }
        }
    }]);

function dataURItoBlob(dataURI) {

    var byteString = atob(dataURI.split(',')[1]);
    var ab = new ArrayBuffer(byteString.length);
    var ia = new Uint8Array(ab);
    for (var i = 0; i < byteString.length; i++) {
        ia[i] = byteString.charCodeAt(i);
    }
    return new Blob([ia], { type: 'image/png' });

}

visualizerApp.filter('filterByKitchen', function () {
    return function (items, KitchenType) {
        var filtered = [];
        angular.forEach(items, function (item) {
            if (item.KitchenGroup.toUpperCase().indexOf(KitchenType.join(",")) >= 0) {
                filtered.push(item);
            }
        });
        return filtered;
    };
});

visualizerApp.filter('filterByNS', function () {
    return function (items, Countertop) {
        //console.log(Countertop);
        var filtered = [];
        angular.forEach(items, function (item) {
            if ((Countertop.NaturalStone == Countertop.Quartz) || (item.MaterialType.toUpperCase().indexOf("NATURAL") >= 0 && Countertop.NaturalStone) || (item.MaterialType.toUpperCase().indexOf("QUARTZ") >= 0 && Countertop.Quartz)) {
                filtered.push(item);
            }
        });
        return filtered;
    };
});

visualizerApp.filter('unique', function () {
    return function (items, filterOn) {

        if (filterOn === false) {
            return items;
        }

        if ((filterOn || angular.isUndefined(filterOn)) && angular.isArray(items)) {
            var hashCheck = {}, newItems = [];

            var extractValueToCompare = function (item) {
                if (angular.isObject(item) && angular.isString(filterOn)) {
                    return item[filterOn];
                } else {
                    return item;
                }
            };

            angular.forEach(items, function (item) {
                var valueToCheck, isDuplicate = false;

                for (var i = 0; i < newItems.length; i++) {
                    if (angular.equals(extractValueToCompare(newItems[i]), extractValueToCompare(item))) {
                        isDuplicate = true;
                        break;
                    }
                }
                if (!isDuplicate) {
                    newItems.push(item);
                }

            });
            items = newItems;
        }
        return items;
    };
});

visualizerApp.directive('smartSrc', function () {
    return {
        restrict: 'A', //attribute directive
        scope: { //isolate scope
            smartSrc: '@', //smart src
            smartSrcWatch: '&' //$watch hook
        },
        link: function (scope, element) {
            //cache for cleanup
            var unwatcher = scope.$watch(scope.smartSrcWatch, function (newVal) {
                //validate $watch
                console.log(newVal);
                if (newVal) {
                    //add src
                    element.attr('src', scope.smartSrc);
                    //cleanup
                    unwatcher();
                }
            });
        }
    };
});

/**
 * Adobe Edge: symbol definitions
 */
(function($, Edge, compId){
//images folder
var im='images/';

var fonts = {};


var resources = [
];
var symbols = {
"stage": {
   version: "1.5.0",
   minimumCompatibleVersion: "1.5.0",
   build: "1.5.0.217",
   baseState: "Base State",
   initialState: "Base State",
   gpuAccelerate: false,
   resizeInstances: false,
   content: {
         dom: [
         {
            id:'Text',
            type:'text',
            rect:['70px','9px','400px','35px','auto','auto'],
            text:"屏 東 好 所 在<br>",
            align:"center",
            font:['Arial, Helvetica, sans-serif',25,"rgba(16,188,16,1.00)","400","none",""]
         },
         {
            id:'RoundRect',
            type:'rect',
            rect:['15px','76px','128px','57px','auto','auto'],
            borderRadius:["10px","10px","10px","10px"],
            fill:["rgba(174,243,194,1.00)",[270,[['rgba(255,255,255,1.00)',0],['rgba(174,243,194,1.00)',59]]]],
            stroke:[1,"rgba(75,115,235,1.00)","solid"]
         },
         {
            id:'Text2',
            type:'text',
            rect:['15px','91px','130px','35px','auto','auto'],
            text:"三 地 門",
            align:"center",
            font:['Arial, Helvetica, sans-serif',27,"rgba(237,110,11,1.00)","700","none","normal"]
         },
         {
            id:'RoundRectCopy',
            type:'rect',
            rect:['205px','76px','128px','57px','auto','auto'],
            borderRadius:["10px","10px","10px","10px"],
            fill:["rgba(174,243,194,1.00)",[270,[['rgba(255,255,255,1.00)',0],['rgba(174,243,194,1.00)',59]]]],
            stroke:[1,"rgba(75,115,235,1.00)","solid"]
         },
         {
            id:'RoundRectCopy2',
            type:'rect',
            rect:['396px','76px','128px','57px','auto','auto'],
            borderRadius:["10px","10px","10px","10px"],
            fill:["rgba(174,243,194,1.00)",[270,[['rgba(255,255,255,1.00)',0],['rgba(174,243,194,1.00)',59]]]],
            stroke:[1,"rgba(75,115,235,1.00)","solid"]
         },
         {
            id:'Text2Copy',
            type:'text',
            rect:['205px','88px','130px','35px','auto','auto'],
            text:"大 鴕 家",
            align:"center",
            font:['Arial, Helvetica, sans-serif',27,"rgba(237,110,11,1.00)","700","none","normal"]
         },
         {
            id:'Text2Copy2',
            type:'text',
            rect:['396px','91px','130px','29px','auto','auto'],
            text:"鹽 埔 果 農",
            align:"center",
            font:['Arial, Helvetica, sans-serif',26,"rgba(237,110,11,1.00)","700","none","normal"]
         },
         {
            id:'arrow',
            type:'image',
            rect:['154px','91px','45px','35px','auto','auto'],
            fill:["rgba(0,0,0,0)",im+"arrow.jpg",'0px','0px']
         },
         {
            id:'arrowCopy',
            type:'image',
            rect:['345px','91px','45px','35px','auto','auto'],
            fill:["rgba(0,0,0,0)",im+"arrow.jpg",'0px','0px']
         },
         {
            id:'Text3',
            type:'text',
            rect:['20px','44px','119px','27px','auto','auto'],
            text:"上 午",
            align:"center",
            font:['Arial, Helvetica, sans-serif',22,"rgba(74,111,244,1.00)","bold","none","normal"]
         },
         {
            id:'Text3Copy',
            type:'text',
            rect:['210px','44px','119px','27px','auto','auto'],
            text:"中 午",
            align:"center",
            font:['Arial, Helvetica, sans-serif',22,"rgba(74,111,244,1.00)","bold","none","normal"]
         },
         {
            id:'Text3Copy2',
            type:'text',
            rect:['401px','44px','119px','27px','auto','auto'],
            text:"下 午",
            align:"center",
            font:['Arial, Helvetica, sans-serif',22,"rgba(74,111,244,1.00)","bold","none","normal"]
         }],
         symbolInstances: [

         ]
      },
   states: {
      "Base State": {
         "${_RoundRect}": [
            ["color", "background-color", 'rgba(174,243,194,1.00)'],
            ["color", "border-color", 'rgba(75,115,235,1.00)'],
            ["style", "border-width", '1px'],
            ["style", "border-style", 'solid'],
            ["style", "height", '57px'],
            ["gradient", "background-image", [270,[['rgba(255,255,255,1.00)',0],['rgba(174,243,194,1.00)',59]]]],
            ["style", "left", '15px'],
            ["style", "width", '128px']
         ],
         "${_Text3Copy}": [
            ["color", "color", 'rgba(74,111,244,1)'],
            ["style", "left", '210px'],
            ["style", "font-size", '22px']
         ],
         "${_arrow}": [
            ["style", "top", '91px'],
            ["style", "height", '35px'],
            ["style", "left", '154px'],
            ["style", "width", '45px']
         ],
         "${_Text3Copy2}": [
            ["color", "color", 'rgba(74,111,244,1)'],
            ["style", "left", '401px'],
            ["style", "font-size", '22px']
         ],
         "${_Text2}": [
            ["style", "top", '91px'],
            ["color", "color", 'rgba(237,110,11,1.00)'],
            ["style", "font-weight", '700'],
            ["style", "left", '15px'],
            ["style", "font-size", '27px']
         ],
         "${_Text2Copy2}": [
            ["style", "top", '91px'],
            ["style", "height", '29px'],
            ["style", "font-size", '26px'],
            ["color", "color", 'rgba(237,110,11,1)'],
            ["style", "font-weight", 'bold'],
            ["style", "left", '396px'],
            ["style", "width", '130px']
         ],
         "${_Text}": [
            ["style", "top", '9px'],
            ["style", "width", '400px'],
            ["style", "text-align", 'center'],
            ["style", "height", '35px'],
            ["color", "color", 'rgba(16,188,16,1.00)'],
            ["style", "font-weight", '400'],
            ["style", "left", '70px'],
            ["style", "font-size", '25px']
         ],
         "${_RoundRectCopy2}": [
            ["color", "background-color", 'rgba(174,243,194,1)'],
            ["gradient", "background-image", [270,[['rgba(255,255,255,1.00)',0],['rgba(174,243,194,1.00)',59]]]],
            ["style", "border-width", '1px'],
            ["style", "width", '128px'],
            ["style", "top", '76px'],
            ["style", "height", '57px'],
            ["color", "border-color", 'rgb(75, 115, 235)'],
            ["style", "border-style", 'solid'],
            ["style", "left", '396px']
         ],
         "${_RoundRectCopy}": [
            ["color", "background-color", 'rgba(174,243,194,1)'],
            ["gradient", "background-image", [270,[['rgba(255,255,255,1.00)',0],['rgba(174,243,194,1.00)',59]]]],
            ["style", "border-width", '1px'],
            ["style", "width", '128px'],
            ["style", "top", '76px'],
            ["style", "height", '57px'],
            ["color", "border-color", 'rgb(75, 115, 235)'],
            ["style", "border-style", 'solid'],
            ["style", "left", '205px']
         ],
         "${_Stage}": [
            ["color", "background-color", 'rgba(245,235,208,1.00)'],
            ["style", "overflow", 'hidden'],
            ["style", "height", '180px'],
            ["style", "width", '540px']
         ],
         "${_arrowCopy}": [
            ["style", "height", '35px'],
            ["style", "top", '91px'],
            ["style", "left", '345px'],
            ["style", "width", '45px']
         ],
         "${_Text3}": [
            ["color", "color", 'rgba(74,111,244,1.00)'],
            ["style", "left", '20px'],
            ["style", "font-size", '22px']
         ],
         "${_Text2Copy}": [
            ["style", "top", '88px'],
            ["color", "color", 'rgba(237,110,11,1)'],
            ["style", "font-weight", 'bold'],
            ["style", "left", '205px'],
            ["style", "font-size", '27px']
         ]
      }
   },
   timelines: {
      "Default Timeline": {
         fromState: "Base State",
         toState: "",
         duration: 0,
         autoPlay: true,
         timeline: [
         ]
      }
   }
}
};


Edge.registerCompositionDefn(compId, symbols, fonts, resources);

/**
 * Adobe Edge DOM Ready Event Handler
 */
$(window).ready(function() {
     Edge.launchComposition(compId);
});
})(jQuery, AdobeEdge, "EDGE-15286928");

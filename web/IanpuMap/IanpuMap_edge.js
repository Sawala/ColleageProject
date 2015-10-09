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
            id:'ianpu3',
            display:'none',
            type:'image',
            rect:['800px','200px','400px','288px','auto','auto'],
            fill:["rgba(0,0,0,0)",im+"ianpu3.jpg",'0px','0px']
         },
         {
            id:'ianpu2',
            display:'none',
            type:'image',
            rect:['295px','50px','300px','300px','auto','auto'],
            fill:["rgba(0,0,0,0)",im+"ianpu2.jpg",'0px','0px']
         },
         {
            id:'RoundRect2',
            display:'none',
            type:'rect',
            rect:['441px','220px','37px','24px','auto','auto'],
            borderRadius:["10px","10px","10px","10px"],
            fill:["rgba(192,192,192,0)"],
            stroke:[3,"rgba(36,240,30,1.00)","dotted"]
         },
         {
            id:'cancel_btn',
            display:'none',
            type:'image',
            rect:['546px','50px','26px','26px','auto','auto'],
            cursor:['pointer'],
            fill:["rgba(0,0,0,0)",im+"cancel%20btn.jpg",'0px','0px']
         },
         {
            id:'cancel_btnCopy',
            display:'none',
            type:'image',
            rect:['959px','50px','26px','26px','auto','auto'],
            cursor:['pointer'],
            fill:["rgba(0,0,0,0)",im+"cancel%20btn.jpg",'0px','0px']
         },
         {
            id:'ianpu1',
            type:'image',
            rect:['149px','0px','233px','450px','auto','auto'],
            fill:["rgba(0,0,0,0)",im+"ianpu1.jpg",'0px','0px']
         },
         {
            id:'Ellipse',
            type:'ellipse',
            rect:['186px','290px','86px','170px','auto','auto'],
            borderRadius:["50%","50%","50%","50%"],
            fill:["rgba(192,192,192,0.00)"],
            stroke:[5,"rgba(36,240,30,1.00)","dotted"]
         },
         {
            id:'Text',
            type:'text',
            rect:['308px','440px','220px','30px','auto','auto'],
            text:"請將滑鼠移至紅色區塊",
            font:['Arial, Helvetica, sans-serif',21,"rgba(0,0,0,1)","700","none",""]
         }],
         symbolInstances: [

         ]
      },
   states: {
      "Base State": {
         "${_ianpu3}": [
            ["style", "top", '11px'],
            ["style", "display", 'none'],
            ["style", "height", '288px'],
            ["style", "left", '66px'],
            ["style", "width", '400px']
         ],
         "${_ianpu2}": [
            ["style", "top", '0px'],
            ["style", "height", '310px'],
            ["style", "display", 'none'],
            ["style", "cursor", 'auto'],
            ["style", "left", '111px'],
            ["style", "width", '310px']
         ],
         "${_RoundRect2}": [
            ["style", "top", '43px'],
            ["style", "height", '34px'],
            ["style", "border-width", '3px'],
            ["color", "border-color", 'rgba(36,240,30,1.00)'],
            ["style", "display", 'none'],
            ["style", "border-style", 'dotted'],
            ["style", "left", '162px'],
            ["style", "width", '51px']
         ],
         "${_cancel_btnCopy}": [
            ["style", "top", '11px'],
            ["style", "display", 'none'],
            ["style", "height", '35px'],
            ["style", "cursor", 'pointer'],
            ["style", "left", '431px'],
            ["style", "width", '35px']
         ],
         "${_Text}": [
            ["style", "top", '280px'],
            ["style", "width", '220px'],
            ["style", "height", '30px'],
            ["style", "display", 'block'],
            ["style", "font-weight", '700'],
            ["style", "left", '288px'],
            ["style", "font-size", '21px']
         ],
         "${_Stage}": [
            ["color", "background-color", 'rgba(245,235,208,0.00)'],
            ["style", "overflow", 'hidden'],
            ["style", "height", '310px'],
            ["style", "width", '531px']
         ],
         "${_cancel_btn}": [
            ["style", "top", '0px'],
            ["style", "display", 'none'],
            ["style", "height", '35px'],
            ["style", "cursor", 'pointer'],
            ["style", "left", '386px'],
            ["style", "width", '35px']
         ],
         "${_ianpu1}": [
            ["style", "top", '0px'],
            ["style", "height", '310px'],
            ["style", "display", 'block'],
            ["style", "left", '149px'],
            ["style", "width", '161px']
         ],
         "${_Ellipse}": [
            ["color", "background-color", 'rgba(192,192,192,0.00)'],
            ["style", "border-style", 'dotted'],
            ["style", "border-width", '5px'],
            ["style", "width", '43px'],
            ["style", "top", '210px'],
            ["style", "display", 'block'],
            ["color", "border-color", 'rgba(36,240,30,1.00)'],
            ["style", "left", '184px'],
            ["style", "height", '90px']
         ]
      }
   },
   timelines: {
      "Default Timeline": {
         fromState: "Base State",
         toState: "",
         duration: 1000,
         autoPlay: true,
         labels: {
            "taiwan": 0,
            "pintung": 500,
            "ianpu": 1000
         },
         timeline: [
            { id: "eid2", tween: [ "style", "${_ianpu2}", "display", 'none', { fromValue: 'none'}], position: 0, duration: 0 },
            { id: "eid3", tween: [ "style", "${_ianpu2}", "display", 'block', { fromValue: 'none'}], position: 500, duration: 0 },
            { id: "eid56", tween: [ "style", "${_ianpu2}", "display", 'none', { fromValue: 'block'}], position: 1000, duration: 0 },
            { id: "eid36", tween: [ "style", "${_ianpu1}", "display", 'none', { fromValue: 'block'}], position: 500, duration: 0 },
            { id: "eid10", tween: [ "style", "${_cancel_btnCopy}", "display", 'none', { fromValue: 'none'}], position: 0, duration: 0 },
            { id: "eid11", tween: [ "style", "${_cancel_btnCopy}", "display", 'block', { fromValue: 'none'}], position: 1000, duration: 0 },
            { id: "eid35", tween: [ "style", "${_Ellipse}", "display", 'none', { fromValue: 'block'}], position: 500, duration: 0 },
            { id: "eid8", tween: [ "style", "${_cancel_btn}", "display", 'none', { fromValue: 'none'}], position: 0, duration: 0 },
            { id: "eid9", tween: [ "style", "${_cancel_btn}", "display", 'block', { fromValue: 'none'}], position: 500, duration: 0 },
            { id: "eid58", tween: [ "style", "${_cancel_btn}", "display", 'none', { fromValue: 'block'}], position: 1000, duration: 0 },
            { id: "eid65", tween: [ "style", "${_Text}", "display", 'none', { fromValue: 'block'}], position: 1000, duration: 0 },
            { id: "eid32", tween: [ "style", "${_RoundRect2}", "display", 'block', { fromValue: 'none'}], position: 500, duration: 0 },
            { id: "eid57", tween: [ "style", "${_RoundRect2}", "display", 'none', { fromValue: 'block'}], position: 1000, duration: 0 },
            { id: "eid33", tween: [ "style", "${_ianpu3}", "display", 'none', { fromValue: 'none'}], position: 0, duration: 0 },
            { id: "eid34", tween: [ "style", "${_ianpu3}", "display", 'block', { fromValue: 'none'}], position: 1000, duration: 0 }         ]
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
})(jQuery, AdobeEdge, "EDGE-9263477");

/***********************
* Adobe Edge Animate Composition Actions
*
* Edit this file with caution, being careful to preserve 
* function signatures and comments starting with 'Edge' to maintain the 
* ability to interact with these actions from within Adobe Edge Animate
*
***********************/
(function($, Edge, compId){
var Composition = Edge.Composition, Symbol = Edge.Symbol; // aliases for commonly used Edge classes

   //Edge symbol: 'stage'
   (function(symbolName) {
      
      
      Symbol.bindElementAction(compId, symbolName, "${_RoundRect}", "click", function(sym, e) {
         sym.play("one");
         

      });
      //Edge binding end

      Symbol.bindTriggerAction(compId, symbolName, "Default Timeline", 1000, function(sym, e) {
         sym.stop();

      });
      //Edge binding end

      Symbol.bindTriggerAction(compId, symbolName, "Default Timeline", 2250, function(sym, e) {
         sym.stop();

      });
      //Edge binding end

      Symbol.bindElementAction(compId, symbolName, "${_RoundRectCopy}", "click", function(sym, e) {
         sym.play("two");
         

      });
      //Edge binding end

      Symbol.bindElementAction(compId, symbolName, "${_RoundRectCopy2}", "click", function(sym, e) {
         sym.play("three");
         

      });
      //Edge binding end

      Symbol.bindTriggerAction(compId, symbolName, "Default Timeline", 3500, function(sym, e) {
         sym.stop();

      });
      //Edge binding end

      

      Symbol.bindTriggerAction(compId, symbolName, "Default Timeline", 4750, function(sym, e) {
         sym.stop();

      });
      //Edge binding end

      Symbol.bindElementAction(compId, symbolName, "${_Text}", "click", function(sym, e) {
         sym.play("one");
         

      });
      //Edge binding end

      Symbol.bindElementAction(compId, symbolName, "${_Text2}", "click", function(sym, e) {
         sym.play("two");
         

      });
      //Edge binding end

      Symbol.bindElementAction(compId, symbolName, "${_Text3}", "click", function(sym, e) {
         sym.play("three");
         

      });
      //Edge binding end

      

      Symbol.bindTriggerAction(compId, symbolName, "Default Timeline", 6000, function(sym, e) {
         sym.stop();

      });
      //Edge binding end

      Symbol.bindTriggerAction(compId, symbolName, "Default Timeline", 7250, function(sym, e) {
         sym.stop();

      });
      //Edge binding end

      Symbol.bindTriggerAction(compId, symbolName, "Default Timeline", 8500, function(sym, e) {
         sym.stop();

      });
      //Edge binding end

      Symbol.bindTriggerAction(compId, symbolName, "Default Timeline", 9750, function(sym, e) {
         sym.stop();

      });
      //Edge binding end

      Symbol.bindTriggerAction(compId, symbolName, "Default Timeline", 11000, function(sym, e) {
         sym.stop();

      });
      //Edge binding end

      Symbol.bindElementAction(compId, symbolName, "${_TextCopy}", "click", function(sym, e) {
         sym.play("four");
         

      });
      //Edge binding end

      Symbol.bindElementAction(compId, symbolName, "${_RoundRectCopy3}", "click", function(sym, e) {
         sym.play("four");
         

      });
      //Edge binding end

      Symbol.bindElementAction(compId, symbolName, "${_TextCopy2}", "click", function(sym, e) {
         sym.play("five");
         

      });
      //Edge binding end

      Symbol.bindElementAction(compId, symbolName, "${_RoundRectCopy4}", "click", function(sym, e) {
         sym.play("five");
         

      });
      //Edge binding end

      Symbol.bindElementAction(compId, symbolName, "${_TextCopy3}", "click", function(sym, e) {
         sym.play("six");
         

      });
      //Edge binding end

      Symbol.bindElementAction(compId, symbolName, "${_RoundRectCopy5}", "click", function(sym, e) {
         sym.play("six");
         

      });
      //Edge binding end

      Symbol.bindElementAction(compId, symbolName, "${_TextCopy4}", "click", function(sym, e) {
         sym.play("seven");
         

      });
      //Edge binding end

      Symbol.bindElementAction(compId, symbolName, "${_RoundRectCopy6}", "click", function(sym, e) {
         sym.play("seven");
         

      });
      //Edge binding end

      Symbol.bindElementAction(compId, symbolName, "${_TextCopy5}", "click", function(sym, e) {
         sym.play("eight");
         

      });
      //Edge binding end

      Symbol.bindElementAction(compId, symbolName, "${_RoundRectCopy7}", "click", function(sym, e) {
         sym.play("eight");
         

      });
      //Edge binding end

      Symbol.bindElementAction(compId, symbolName, "${_TextCopy6}", "click", function(sym, e) {
         sym.play("nine");
         

      });
      //Edge binding end

      Symbol.bindElementAction(compId, symbolName, "${_RoundRectCopy8}", "click", function(sym, e) {
         sym.play("nine");
         

      });
      //Edge binding end

   })("stage");
   //Edge symbol end:'stage'

})(jQuery, AdobeEdge, "EDGE-6530776");
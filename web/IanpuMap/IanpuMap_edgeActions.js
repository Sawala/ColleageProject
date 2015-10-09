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
      
      
      

      Symbol.bindTriggerAction(compId, symbolName, "Default Timeline", 500, function(sym, e) {
         sym.stop("pintung");

      });
      //Edge binding end

      Symbol.bindTriggerAction(compId, symbolName, "Default Timeline", 0, function(sym, e) {
         sym.stop("taiwan");

      });
      //Edge binding end

      Symbol.bindElementAction(compId, symbolName, "${_RoundRect2}", "mouseover", function(sym, e) {
         sym.play("ianpu");
         

      });
      //Edge binding end

      Symbol.bindTriggerAction(compId, symbolName, "Default Timeline", 1000, function(sym, e) {
         sym.stop("ianpu");

      });
      //Edge binding end

      

      

      Symbol.bindElementAction(compId, symbolName, "${_cancel_btn}", "click", function(sym, e) {
         sym.play("taiwan");
         

      });
      //Edge binding end

      Symbol.bindElementAction(compId, symbolName, "${_cancel_btnCopy}", "click", function(sym, e) {
         sym.play("pintung");
         

      });
      //Edge binding end

      Symbol.bindElementAction(compId, symbolName, "${_Ellipse}", "mouseover", function(sym, e) {
         sym.play("pintung");
         

      });
      //Edge binding end

   })("stage");
   //Edge symbol end:'stage'

})(jQuery, AdobeEdge, "EDGE-9263477");
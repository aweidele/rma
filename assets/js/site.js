!function(){function n(t,e){if(!(this instanceof n))return new n(t,e);if(!t||"TABLE"!==t.tagName)throw new Error("Element must be a table");this.init(t,e||{})}function b(t){var e;return window.CustomEvent&&"function"==typeof window.CustomEvent?e=new CustomEvent(t):(e=document.createEvent("CustomEvent")).initCustomEvent(t,!1,!1,void 0),e}function w(t){return t.getAttribute("data-sort")||t.textContent||t.innerText||""}function m(t,e){return(t=t.trim().toLowerCase())===(e=e.trim().toLowerCase())?0:t<e?1:-1}function p(o,r){return function(t,e){var n=o(t.td,e.td);return 0===n?r?e.index-t.index:t.index-e.index:n}}var v=[];n.extend=function(t,e,n){if("function"!=typeof e||"function"!=typeof n)throw new Error("Pattern and sort must be a function");v.push({name:t,pattern:e,sort:n})},n.prototype={init:function(t,e){var n,o,r,i,s=this;if(s.table=t,s.thead=!1,s.options=e,t.rows&&0<t.rows.length)if(t.tHead&&0<t.tHead.rows.length){for(r=0;r<t.tHead.rows.length;r++)if("thead"===t.tHead.rows[r].getAttribute("data-sort-method")){n=t.tHead.rows[r];break}n=n||t.tHead.rows[t.tHead.rows.length-1],s.thead=!0}else n=t.rows[0];if(n){function a(){s.current&&s.current!==this&&s.current.removeAttribute("aria-sort"),s.current=this,s.sortTable(this)}for(r=0;r<n.cells.length;r++)(i=n.cells[r]).setAttribute("role","columnheader"),"none"!==i.getAttribute("data-sort-method")&&(i.tabindex=0,i.addEventListener("click",a,!1),null!==i.getAttribute("data-sort-default")&&(o=i));o&&(s.current=o,s.sortTable(o))}},sortTable:function(t,e){var n=this,o=t.cellIndex,r=m,i="",s=[],a=n.thead?0:1,d=t.getAttribute("data-sort-method"),l=t.getAttribute("aria-sort");if(n.table.dispatchEvent(b("beforeSort")),e||(l="ascending"===l?"descending":"descending"===l?"ascending":n.options.descending?"descending":"ascending",t.setAttribute("aria-sort",l)),!(n.table.rows.length<2)){if(!d){for(;s.length<3&&a<n.table.tBodies[0].rows.length;)0<(i=(i=w(n.table.tBodies[0].rows[a].cells[o])).trim()).length&&s.push(i),a++;if(!s)return}for(a=0;a<v.length;a++)if(i=v[a],d){if(i.name===d){r=i.sort;break}}else if(s.every(i.pattern)){r=i.sort;break}for(n.col=o,a=0;a<n.table.tBodies.length;a++){var u,c=[],f={},h=0,g=0;if(!(n.table.tBodies[a].rows.length<2)){for(u=0;u<n.table.tBodies[a].rows.length;u++)"none"===(i=n.table.tBodies[a].rows[u]).getAttribute("data-sort-method")?f[h]=i:c.push({tr:i,td:w(i.cells[n.col]),index:h}),h++;for("descending"===l?c.sort(p(r,!0)):(c.sort(p(r,!1)),c.reverse()),u=0;u<h;u++)f[u]?(i=f[u],g++):i=c[u-g].tr,n.table.tBodies[a].appendChild(i)}}n.table.dispatchEvent(b("afterSort"))}},refresh:function(){void 0!==this.current&&this.sortTable(this.current,!0)}},"undefined"!=typeof module&&module.exports?module.exports=n:window.Tablesort=n}(),function(n){n(".staff-list").length&&(n(".staff-list").each(function(){n("a",this).on("click",function(t){t.preventDefault();var e=n(this).prop("href")+" .main-content";n("body").addClass("dialog-loading"),n("#dialog .dialog-content").load(e,function(){n("body").removeClass("dialog-loading").addClass("dialog-open")})})}),n("#dialog button").on("click",function(){n("body").removeClass("dialog-open")})),new Tablesort(document.getElementById("projectTable"),{descending:!0})}(jQuery);
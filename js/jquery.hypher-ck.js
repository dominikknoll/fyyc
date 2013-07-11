(function(){function t(e){var t=[],n=0;this.trie=this.createTrie(e.patterns);this.leftMin=e.leftmin;this.rightMin=e.rightmin;this.exceptions={};if(e.exceptions){t=e.exceptions.split(/,\s?/g);for(;n<t.length;n+=1)this.exceptions[t[n].replace(/-/g,"")]=t[n].split("")}}var e={exports:null};t.TrieNode;t.prototype.createTrie=function(e){var t=0,n=0,r=0,i=0,s=null,o=null,u=null,a=null,f={_points:[]},l;for(t in e)if(e.hasOwnProperty(t)){l=e[t].match(new RegExp(".{1,"+ +t+"}","g"));for(n=0;n<l.length;n+=1){s=l[n].replace(/[0-9]/g,"").split("");o=l[n].split(/\D/);a=f;for(r=0;r<s.length;r+=1){u=s[r].charCodeAt(0);a[u]||(a[u]={});a=a[u]}a._points=[];for(i=0;i<o.length;i+=1)a._points[i]=o[i]||0}}return f};t.prototype.hyphenateText=function(e,t){t=t||4;var n=e.split(/\b/g);for(var r=0;r<n.length;r+=1)n[r].indexOf("/")!==-1?r!==0&&r!==n.length-1&&!/\s+\/|\/\s+/.test(n[r])&&(n[r]+="​"):n[r].length>t&&(n[r]=this.hyphenate(n[r]).join("­"));return n.join("")};t.prototype.hyphenate=function(e){var t,n=[],r,i,s,o,u,a=[],f,l,c,h=Math.max,p=this.trie,d=[""];if(this.exceptions.hasOwnProperty(e))return this.exceptions[e];if(e.indexOf("­")!==-1)return[e];e="_"+e+"_";t=e.toLowerCase().split("");r=e.split("");f=t.length;for(i=0;i<f;i+=1){a[i]=0;n[i]=t[i].charCodeAt(0)}for(i=0;i<f;i+=1){u=p;for(s=i;s<f;s+=1){u=u[n[s]];if(!u)break;l=u._points;if(l)for(o=0,c=l.length;o<c;o+=1)a[i+o]=h(a[i+o],l[o])}}for(i=1;i<f-1;i+=1)i>this.leftMin&&i<f-this.rightMin&&a[i]%2?d.push(r[i]):d[d.length-1]+=r[i];return d};e.exports=t;window.Hypher=e.exports;window.Hypher.languages={}})();(function(e){e.fn.hyphenate=function(e){if(window.Hypher.languages[e])return this.each(function(){var t=0,n=this.childNodes.length;for(;t<n;t+=1)this.childNodes[t].nodeType===3&&(this.childNodes[t].nodeValue=window.Hypher.languages[e].hyphenateText(this.childNodes[t].nodeValue))})}})(jQuery);
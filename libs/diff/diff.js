     /*
     * Javascript Diff Algorithm
     *  By John Resig (http://ejohn.org/)
     *  Modified by Chu Alan "sprite"
     *
     * Released under the MIT license.
     *
     * More Info:
     *  http://ejohn.org/projects/javascript-diff-algorithm/
     */
    
    function caip_escape(s) {
        var n = s;
        n = n.replace(/&/g, "&amp;");
        n = n.replace(/</g, "&lt;");
        n = n.replace(/>/g, "&gt;");
        n = n.replace(/"/g, "&quot;");
    
        return n;
    }
	function caip_textpath(text, diffs) {
		let result = '';
		let pointer = 0;

		for (const [op, data] of diffs) {
			if (op === '=') {
			  // No change needed
			  result += text.substring(pointer, pointer + data.length);
			  pointer += data.length;
			} else if (op === '-') {
			  // Deletion
			  pointer += data.length;
			} else if (op === '+') {
			  // Insertion
			  result += data;
			}
		}

		result += text.substring(pointer);
		return result;
	}
    
    function caip_diffString( o, n ) {
      o = o.replace(/\s+$/, '');
      n = n.replace(/\s+$/, '');
    
      var out = caip_diff(o == "" ? [] : o.split(/\s+/), n == "" ? [] : n.split(/\s+/) );
      var str = "";
    
      var oSpace = o.match(/\s+/g);
      if (oSpace == null) {
        oSpace = ["\n"];
      } else {
        oSpace.push("\n");
      }
      var nSpace = n.match(/\s+/g);
      if (nSpace == null) {
        nSpace = ["\n"];
      } else {
        nSpace.push("\n");
      }
    
      if (out.n.length == 0) {
          for (var i = 0; i < out.o.length; i++) {
            //str += '<del>' + escape(out.o[i]) + oSpace[i] + "</del>";
          }
      } else {
        if (out.n[0].text == null) {
          for (n = 0; n < out.o.length && out.o[n].text == null; n++) {
            //str += '<del>' + escape(out.o[n]) + oSpace[n] + "</del>";
          }
        }
    
        for ( var i = 0; i < out.n.length; i++ ) {
          if (out.n[i].text == null) {
            //str += '<ins class="caip_blue">' + caip_escape(out.n[i]) + nSpace[i] + "</ins>";
            str += '<span class="caip_blue">' + (out.n[i]) + nSpace[i] + "</span>";
          } else {
            var pre = "";
    
            for (n = out.n[i].row + 1; n < out.o.length && out.o[n].text == null; n++ ) {
              //pre += '<del>' + caip_escape(out.o[n]) + oSpace[n] + "</del>";
            }
            str += " " + out.n[i].text + nSpace[i] + pre;
          }
        }
      }
      
      return str;
    }
    
    function caip_randomColor() {
        return "rgb(" + (Math.random() * 100) + "%, " + 
                        (Math.random() * 100) + "%, " + 
                        (Math.random() * 100) + "%)";
    }
    function caip_diffString2( o, n ) {
      o = o.replace(/\s+$/, '');
      n = n.replace(/\s+$/, '');
    
      var out = caip_diff(o == "" ? [] : o.split(/\s+/), n == "" ? [] : n.split(/\s+/) );
    
      var oSpace = o.match(/\s+/g);
      if (oSpace == null) {
        oSpace = ["\n"];
      } else {
        oSpace.push("\n");
      }
      var nSpace = n.match(/\s+/g);
      if (nSpace == null) {
        nSpace = ["\n"];
      } else {
        nSpace.push("\n");
      }
    
      var os = "";
      var colors = new Array();
      for (var i = 0; i < out.o.length; i++) {
          colors[i] = caip_randomColor();
    
          if (out.o[i].text != null) {
              os += '<span style="background-color: ' +colors[i]+ '">' + 
                    caip_escape(out.o[i].text) + oSpace[i] + "</span>";
          } else {
             // os += "<del>" + caip_escape(out.o[i]) + oSpace[i] + "</del>";
          }
      }
    
      var ns = "";
      for (var i = 0; i < out.n.length; i++) {
          if (out.n[i].text != null) {
              ns += '<span style="background-color: ' +colors[out.n[i].row]+ '">' + 
                    caip_escape(out.n[i].text) + nSpace[i] + "</span>";
          } else {
              ns += "<span class=\"caip_blue\">" + caip_escape(out.n[i]) + nSpace[i] + "</span>";
          }
      }
    
      return { o : os , n : ns };
    }
    
    function caip_diff( o, n ) {
      var ns = new Object();
      var os = new Object();
      
      for ( var i = 0; i < n.length; i++ ) {
        if ( ns[ n[i] ] == null )
          ns[ n[i] ] = { rows: new Array(), o: null };
        ns[ n[i] ].rows.push( i );
      }
      
      for ( var i = 0; i < o.length; i++ ) {
        if ( os[ o[i] ] == null )
          os[ o[i] ] = { rows: new Array(), n: null };
        os[ o[i] ].rows.push( i );
      }
      
      for ( var i in ns ) {
        if ( ns[i].rows.length == 1 && typeof(os[i]) != "undefined" && os[i].rows.length == 1 ) {
          n[ ns[i].rows[0] ] = { text: n[ ns[i].rows[0] ], row: os[i].rows[0] };
          o[ os[i].rows[0] ] = { text: o[ os[i].rows[0] ], row: ns[i].rows[0] };
        }
      }
      
      for ( var i = 0; i < n.length - 1; i++ ) {
        if ( n[i].text != null && n[i+1].text == null && n[i].row + 1 < o.length && o[ n[i].row + 1 ].text == null && 
             n[i+1] == o[ n[i].row + 1 ] ) {
          n[i+1] = { text: n[i+1], row: n[i].row + 1 };
          o[n[i].row+1] = { text: o[n[i].row+1], row: i + 1 };
        }
      }
      
      for ( var i = n.length - 1; i > 0; i-- ) {
        if ( n[i].text != null && n[i-1].text == null && n[i].row > 0 && o[ n[i].row - 1 ].text == null && 
             n[i-1] == o[ n[i].row - 1 ] ) {
          n[i-1] = { text: n[i-1], row: n[i].row - 1 };
          o[n[i].row-1] = { text: o[n[i].row-1], row: i - 1 };
        }
      }
      
      return { o: o, n: n };
    }
    jQuery.fn.caip_diffString = function(txt){
        return this.each(function(){
            $(this).html(diffString($(this).text(),txt));
        });
    };

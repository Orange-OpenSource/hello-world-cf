/* http://prismjs.com/download.html?themes=prism-okaidia&languages=markup+css+css-extras+clike+javascript+php+php-extras+sql+http+ini&plugins=line-numbers+autolinker+file-highlight+show-language */
var self = typeof window != "undefined" ? window : {}, Prism = function () {
    var e = /\blang(?:uage)?-(?!\*)(\w+)\b/i, t = self.Prism = {util: {encode: function (e) {
        return e instanceof n ? new n(e.type, t.util.encode(e.content)) : t.util.type(e) === "Array" ? e.map(t.util.encode) : e.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/\u00a0/g, " ")
    }, type: function (e) {
        return Object.prototype.toString.call(e).match(/\[object (\w+)\]/)[1]
    }, clone: function (e) {
        var n = t.util.type(e);
        switch (n) {
            case"Object":
                var r = {};
                for (var i in e)e.hasOwnProperty(i) && (r[i] = t.util.clone(e[i]));
                return r;
            case"Array":
                return e.slice()
        }
        return e
    }}, languages: {extend: function (e, n) {
        var r = t.util.clone(t.languages[e]);
        for (var i in n)r[i] = n[i];
        return r
    }, insertBefore: function (e, n, r, i) {
        i = i || t.languages;
        var s = i[e], o = {};
        for (var u in s)if (s.hasOwnProperty(u)) {
            if (u == n)for (var a in r)r.hasOwnProperty(a) && (o[a] = r[a]);
            o[u] = s[u]
        }
        return i[e] = o
    }, DFS: function (e, n) {
        for (var r in e) {
            n.call(e, r, e[r]);
            t.util.type(e) === "Object" && t.languages.DFS(e[r], n)
        }
    }}, highlightAll: function (e, n) {
        var r = document.querySelectorAll('code[class*="language-"], [class*="language-"] code, code[class*="lang-"], [class*="lang-"] code');
        for (var i = 0, s; s = r[i++];)t.highlightElement(s, e === !0, n)
    }, highlightElement: function (r, i, s) {
        var o, u, a = r;
        while (a && !e.test(a.className))a = a.parentNode;
        if (a) {
            o = (a.className.match(e) || [, ""])[1];
            u = t.languages[o]
        }
        if (!u)return;
        r.className = r.className.replace(e, "").replace(/\s+/g, " ") + " language-" + o;
        a = r.parentNode;
        /pre/i.test(a.nodeName) && (a.className = a.className.replace(e, "").replace(/\s+/g, " ") + " language-" + o);
        var f = r.textContent;
        if (!f)return;
        var l = {element: r, language: o, grammar: u, code: f};
        t.hooks.run("before-highlight", l);
        if (i && self.Worker) {
            var c = new Worker(t.filename);
            c.onmessage = function (e) {
                l.highlightedCode = n.stringify(JSON.parse(e.data), o);
                t.hooks.run("before-insert", l);
                l.element.innerHTML = l.highlightedCode;
                s && s.call(l.element);
                t.hooks.run("after-highlight", l)
            };
            c.postMessage(JSON.stringify({language: l.language, code: l.code}))
        } else {
            l.highlightedCode = t.highlight(l.code, l.grammar, l.language);
            t.hooks.run("before-insert", l);
            l.element.innerHTML = l.highlightedCode;
            s && s.call(r);
            t.hooks.run("after-highlight", l)
        }
    }, highlight: function (e, r, i) {
        var s = t.tokenize(e, r);
        return n.stringify(t.util.encode(s), i)
    }, tokenize: function (e, n, r) {
        var i = t.Token, s = [e], o = n.rest;
        if (o) {
            for (var u in o)n[u] = o[u];
            delete n.rest
        }
        e:for (var u in n) {
            if (!n.hasOwnProperty(u) || !n[u])continue;
            var a = n[u], f = a.inside, l = !!a.lookbehind, c = 0;
            a = a.pattern || a;
            for (var h = 0; h < s.length; h++) {
                var p = s[h];
                if (s.length > e.length)break e;
                if (p instanceof i)continue;
                a.lastIndex = 0;
                var d = a.exec(p);
                if (d) {
                    l && (c = d[1].length);
                    var v = d.index - 1 + c, d = d[0].slice(c), m = d.length, g = v + m, y = p.slice(0, v + 1), b = p.slice(g + 1), w = [h, 1];
                    y && w.push(y);
                    var E = new i(u, f ? t.tokenize(d, f) : d);
                    w.push(E);
                    b && w.push(b);
                    Array.prototype.splice.apply(s, w)
                }
            }
        }
        return s
    }, hooks: {all: {}, add: function (e, n) {
        var r = t.hooks.all;
        r[e] = r[e] || [];
        r[e].push(n)
    }, run: function (e, n) {
        var r = t.hooks.all[e];
        if (!r || !r.length)return;
        for (var i = 0, s; s = r[i++];)s(n)
    }}}, n = t.Token = function (e, t) {
        this.type = e;
        this.content = t
    };
    n.stringify = function (e, r, i) {
        if (typeof e == "string")return e;
        if (Object.prototype.toString.call(e) == "[object Array]")return e.map(function (t) {
            return n.stringify(t, r, e)
        }).join("");
        var s = {type: e.type, content: n.stringify(e.content, r, i), tag: "span", classes: ["token", e.type], attributes: {}, language: r, parent: i};
        s.type == "comment" && (s.attributes.spellcheck = "true");
        t.hooks.run("wrap", s);
        var o = "";
        for (var u in s.attributes)o += u + '="' + (s.attributes[u] || "") + '"';
        return"<" + s.tag + ' class="' + s.classes.join(" ") + '" ' + o + ">" + s.content + "</" + s.tag + ">"
    };
    if (!self.document) {
        if (!self.addEventListener)return self.Prism;
        self.addEventListener("message", function (e) {
            var n = JSON.parse(e.data), r = n.language, i = n.code;
            self.postMessage(JSON.stringify(t.tokenize(i, t.languages[r])));
            self.close()
        }, !1);
        return self.Prism
    }
    var r = document.getElementsByTagName("script");
    r = r[r.length - 1];
    if (r) {
        t.filename = r.src;
        document.addEventListener && !r.hasAttribute("data-manual") && document.addEventListener("DOMContentLoaded", t.highlightAll)
    }
    return self.Prism
}();
typeof module != "undefined" && module.exports && (module.exports = Prism);
;
Prism.languages.markup = {comment: /<!--[\w\W]*?-->/g, prolog: /<\?.+?\?>/, doctype: /<!DOCTYPE.+?>/, cdata: /<!\[CDATA\[[\w\W]*?]]>/i, tag: {pattern: /<\/?[\w:-]+\s*(?:\s+[\w:-]+(?:=(?:("|')(\\?[\w\W])*?\1|[^\s'">=]+))?\s*)*\/?>/gi, inside: {tag: {pattern: /^<\/?[\w:-]+/i, inside: {punctuation: /^<\/?/, namespace: /^[\w-]+?:/}}, "attr-value": {pattern: /=(?:('|")[\w\W]*?(\1)|[^\s>]+)/gi, inside: {punctuation: /=|>|"/g}}, punctuation: /\/?>/g, "attr-name": {pattern: /[\w:-]+/g, inside: {namespace: /^[\w-]+?:/}}}}, entity: /\&#?[\da-z]{1,8};/gi};
Prism.hooks.add("wrap", function (e) {
    e.type === "entity" && (e.attributes.title = e.content.replace(/&amp;/, "&"))
});
;
Prism.languages.css = {comment: /\/\*[\w\W]*?\*\//g, atrule: {pattern: /@[\w-]+?.*?(;|(?=\s*{))/gi, inside: {punctuation: /[;:]/g}}, url: /url\((["']?).*?\1\)/gi, selector: /[^\{\}\s][^\{\};]*(?=\s*\{)/g, property: /(\b|\B)[\w-]+(?=\s*:)/ig, string: /("|')(\\?.)*?\1/g, important: /\B!important\b/gi, punctuation: /[\{\};:]/g, "function": /[-a-z0-9]+(?=\()/ig};
Prism.languages.markup && Prism.languages.insertBefore("markup", "tag", {style: {pattern: /<style[\w\W]*?>[\w\W]*?<\/style>/ig, inside: {tag: {pattern: /<style[\w\W]*?>|<\/style>/ig, inside: Prism.languages.markup.tag.inside}, rest: Prism.languages.css}}});
;
Prism.languages.css.selector = {pattern: /[^\{\}\s][^\{\}]*(?=\s*\{)/g, inside: {"pseudo-element": /:(?:after|before|first-letter|first-line|selection)|::[-\w]+/g, "pseudo-class": /:[-\w]+(?:\(.*\))?/g, "class": /\.[-:\.\w]+/g, id: /#[-:\.\w]+/g}};
Prism.languages.insertBefore("css", "ignore", {hexcode: /#[\da-f]{3,6}/gi, entity: /\\[\da-f]{1,8}/gi, number: /[\d%\.]+/g});
;
Prism.languages.clike = {comment: {pattern: /(^|[^\\])(\/\*[\w\W]*?\*\/|(^|[^:])\/\/.*?(\r?\n|$))/g, lookbehind: !0}, string: /("|')(\\?.)*?\1/g, "class-name": {pattern: /((?:(?:class|interface|extends|implements|trait|instanceof|new)\s+)|(?:catch\s+\())[a-z0-9_\.\\]+/ig, lookbehind: !0, inside: {punctuation: /(\.|\\)/}}, keyword: /\b(if|else|while|do|for|return|in|instanceof|function|new|try|throw|catch|finally|null|break|continue)\b/g, "boolean": /\b(true|false)\b/g, "function": {pattern: /[a-z0-9_]+\(/ig, inside: {punctuation: /\(/}}, number: /\b-?(0x[\dA-Fa-f]+|\d*\.?\d+([Ee]-?\d+)?)\b/g, operator: /[-+]{1,2}|!|<=?|>=?|={1,3}|&{1,2}|\|?\||\?|\*|\/|\~|\^|\%/g, ignore: /&(lt|gt|amp);/gi, punctuation: /[{}[\];(),.:]/g};
;
Prism.languages.javascript = Prism.languages.extend("clike", {keyword: /\b(break|case|catch|class|const|continue|debugger|default|delete|do|else|enum|export|extends|false|finally|for|function|get|if|implements|import|in|instanceof|interface|let|new|null|package|private|protected|public|return|set|static|super|switch|this|throw|true|try|typeof|var|void|while|with|yield)\b/g, number: /\b-?(0x[\dA-Fa-f]+|\d*\.?\d+([Ee]-?\d+)?|NaN|-?Infinity)\b/g});
Prism.languages.insertBefore("javascript", "keyword", {regex: {pattern: /(^|[^/])\/(?!\/)(\[.+?]|\\.|[^/\r\n])+\/[gim]{0,3}(?=\s*($|[\r\n,.;})]))/g, lookbehind: !0}});
Prism.languages.markup && Prism.languages.insertBefore("markup", "tag", {script: {pattern: /<script[\w\W]*?>[\w\W]*?<\/script>/ig, inside: {tag: {pattern: /<script[\w\W]*?>|<\/script>/ig, inside: Prism.languages.markup.tag.inside}, rest: Prism.languages.javascript}}});
;
/**
 * Original by Aaron Harun: http://aahacreative.com/2012/07/31/php-syntax-highlighting-prism/
 * Modified by Miles Johnson: http://milesj.me
 *
 * Supports the following:
 *        - Extends clike syntax
 *        - Support for PHP 5.3+ (namespaces, traits, generators, etc)
 *        - Smarter constant and function matching
 *
 * Adds the following new token classes:
 *        constant, delimiter, variable, function, package
 */Prism.languages.php = Prism.languages.extend("clike", {keyword: /\b(and|or|xor|array|as|break|case|cfunction|class|const|continue|declare|default|die|do|else|elseif|enddeclare|endfor|endforeach|endif|endswitch|endwhile|extends|for|foreach|function|include|include_once|global|if|new|return|static|switch|use|require|require_once|var|while|abstract|interface|public|implements|private|protected|parent|throw|null|echo|print|trait|namespace|final|yield|goto|instanceof|finally|try|catch)\b/ig, constant: /\b[A-Z0-9_]{2,}\b/g, comment: {pattern: /(^|[^\\])(\/\*[\w\W]*?\*\/|(^|[^:])(\/\/|#).*?(\r?\n|$))/g, lookbehind: !0}});
Prism.languages.insertBefore("php", "keyword", {delimiter: /(\?>|<\?php|<\?)/ig, variable: /(\$\w+)\b/ig, "package": {pattern: /(\\|namespace\s+|use\s+)[\w\\]+/g, lookbehind: !0, inside: {punctuation: /\\/}}});
Prism.languages.insertBefore("php", "operator", {property: {pattern: /(->)[\w]+/g, lookbehind: !0}});
if (Prism.languages.markup) {
    Prism.hooks.add("before-highlight", function (e) {
        if (e.language !== "php")return;
        e.tokenStack = [];
        e.code = e.code.replace(/(?:<\?php|<\?)[\w\W]*?(?:\?>)/ig, function (t) {
            e.tokenStack.push(t);
            return"{{{PHP" + e.tokenStack.length + "}}}"
        })
    });
    Prism.hooks.add("after-highlight", function (e) {
        if (e.language !== "php")return;
        for (var t = 0, n; n = e.tokenStack[t]; t++)e.highlightedCode = e.highlightedCode.replace("{{{PHP" + (t + 1) + "}}}", Prism.highlight(n, e.grammar, "php"));
        e.element.innerHTML = e.highlightedCode
    });
    Prism.hooks.add("wrap", function (e) {
        e.language === "php" && e.type === "markup" && (e.content = e.content.replace(/(\{\{\{PHP[0-9]+\}\}\})/g, '<span class="token php">$1</span>'))
    });
    Prism.languages.insertBefore("php", "comment", {markup: {pattern: /<[^?]\/?(.*?)>/g, inside: Prism.languages.markup}, php: /\{\{\{PHP[0-9]+\}\}\}/g})
}
;
;
Prism.languages.insertBefore("php", "variable", {"this": /\$this/g, global: /\$_?(GLOBALS|SERVER|GET|POST|FILES|REQUEST|SESSION|ENV|COOKIE|HTTP_RAW_POST_DATA|argc|argv|php_errormsg|http_response_header)/g, scope: {pattern: /\b[\w\\]+::/g, inside: {keyword: /(static|self|parent)/, punctuation: /(::|\\)/}}});
;
Prism.languages.sql = {comment: {pattern: /(^|[^\\])(\/\*[\w\W]*?\*\/|((--)|(\/\/)|#).*?(\r?\n|$))/g, lookbehind: !0}, string: /("|')(\\?[\s\S])*?\1/g, keyword: /\b(ACTION|ADD|AFTER|ALGORITHM|ALTER|ANALYZE|APPLY|AS|ASC|AUTHORIZATION|BACKUP|BDB|BEGIN|BERKELEYDB|BIGINT|BINARY|BIT|BLOB|BOOL|BOOLEAN|BREAK|BROWSE|BTREE|BULK|BY|CALL|CASCADE|CASCADED|CASE|CHAIN|CHAR VARYING|CHARACTER VARYING|CHECK|CHECKPOINT|CLOSE|CLUSTERED|COALESCE|COLUMN|COLUMNS|COMMENT|COMMIT|COMMITTED|COMPUTE|CONNECT|CONSISTENT|CONSTRAINT|CONTAINS|CONTAINSTABLE|CONTINUE|CONVERT|CREATE|CROSS|CURRENT|CURRENT_DATE|CURRENT_TIME|CURRENT_TIMESTAMP|CURRENT_USER|CURSOR|DATA|DATABASE|DATABASES|DATETIME|DBCC|DEALLOCATE|DEC|DECIMAL|DECLARE|DEFAULT|DEFINER|DELAYED|DELETE|DENY|DESC|DESCRIBE|DETERMINISTIC|DISABLE|DISCARD|DISK|DISTINCT|DISTINCTROW|DISTRIBUTED|DO|DOUBLE|DOUBLE PRECISION|DROP|DUMMY|DUMP|DUMPFILE|DUPLICATE KEY|ELSE|ENABLE|ENCLOSED BY|END|ENGINE|ENUM|ERRLVL|ERRORS|ESCAPE|ESCAPED BY|EXCEPT|EXEC|EXECUTE|EXIT|EXPLAIN|EXTENDED|FETCH|FIELDS|FILE|FILLFACTOR|FIRST|FIXED|FLOAT|FOLLOWING|FOR|FOR EACH ROW|FORCE|FOREIGN|FREETEXT|FREETEXTTABLE|FROM|FULL|FUNCTION|GEOMETRY|GEOMETRYCOLLECTION|GLOBAL|GOTO|GRANT|GROUP|HANDLER|HASH|HAVING|HOLDLOCK|IDENTITY|IDENTITY_INSERT|IDENTITYCOL|IF|IGNORE|IMPORT|INDEX|INFILE|INNER|INNODB|INOUT|INSERT|INT|INTEGER|INTERSECT|INTO|INVOKER|ISOLATION LEVEL|JOIN|KEY|KEYS|KILL|LANGUAGE SQL|LAST|LEFT|LIMIT|LINENO|LINES|LINESTRING|LOAD|LOCAL|LOCK|LONGBLOB|LONGTEXT|MATCH|MATCHED|MEDIUMBLOB|MEDIUMINT|MEDIUMTEXT|MERGE|MIDDLEINT|MODIFIES SQL DATA|MODIFY|MULTILINESTRING|MULTIPOINT|MULTIPOLYGON|NATIONAL|NATIONAL CHAR VARYING|NATIONAL CHARACTER|NATIONAL CHARACTER VARYING|NATIONAL VARCHAR|NATURAL|NCHAR|NCHAR VARCHAR|NEXT|NO|NO SQL|NOCHECK|NOCYCLE|NONCLUSTERED|NULLIF|NUMERIC|OF|OFF|OFFSETS|ON|OPEN|OPENDATASOURCE|OPENQUERY|OPENROWSET|OPTIMIZE|OPTION|OPTIONALLY|ORDER|OUT|OUTER|OUTFILE|OVER|PARTIAL|PARTITION|PERCENT|PIVOT|PLAN|POINT|POLYGON|PRECEDING|PRECISION|PREV|PRIMARY|PRINT|PRIVILEGES|PROC|PROCEDURE|PUBLIC|PURGE|QUICK|RAISERROR|READ|READS SQL DATA|READTEXT|REAL|RECONFIGURE|REFERENCES|RELEASE|RENAME|REPEATABLE|REPLICATION|REQUIRE|RESTORE|RESTRICT|RETURN|RETURNS|REVOKE|RIGHT|ROLLBACK|ROUTINE|ROWCOUNT|ROWGUIDCOL|ROWS?|RTREE|RULE|SAVE|SAVEPOINT|SCHEMA|SELECT|SERIAL|SERIALIZABLE|SESSION|SESSION_USER|SET|SETUSER|SHARE MODE|SHOW|SHUTDOWN|SIMPLE|SMALLINT|SNAPSHOT|SOME|SONAME|START|STARTING BY|STATISTICS|STATUS|STRIPED|SYSTEM_USER|TABLE|TABLES|TABLESPACE|TEMPORARY|TEMPTABLE|TERMINATED BY|TEXT|TEXTSIZE|THEN|TIMESTAMP|TINYBLOB|TINYINT|TINYTEXT|TO|TOP|TRAN|TRANSACTION|TRANSACTIONS|TRIGGER|TRUNCATE|TSEQUAL|TYPE|TYPES|UNBOUNDED|UNCOMMITTED|UNDEFINED|UNION|UNPIVOT|UPDATE|UPDATETEXT|USAGE|USE|USER|USING|VALUE|VALUES|VARBINARY|VARCHAR|VARCHARACTER|VARYING|VIEW|WAITFOR|WARNINGS|WHEN|WHERE|WHILE|WITH|WITH ROLLUP|WITHIN|WORK|WRITE|WRITETEXT)\b/gi, "boolean": /\b(TRUE|FALSE|NULL)\b/gi, number: /\b-?(0x)?\d*\.?[\da-f]+\b/g, operator: /\b(ALL|AND|ANY|BETWEEN|EXISTS|IN|LIKE|NOT|OR|IS|UNIQUE|CHARACTER SET|COLLATE|DIV|OFFSET|REGEXP|RLIKE|SOUNDS LIKE|XOR)\b|[-+]{1}|!|=?&lt;|=?&gt;|={1}|(&amp;){1,2}|\|?\||\?|\*|\//gi, ignore: /&(lt|gt|amp);/gi, punctuation: /[;[\]()`,.]/g};
;
Prism.languages.http = {"request-line": {pattern: /^(POST|GET|PUT|DELETE|OPTIONS|PATCH|TRACE|CONNECT)\b\shttps?:\/\/\S+\sHTTP\/[0-9.]+/g, inside: {property: /^\b(POST|GET|PUT|DELETE|OPTIONS|PATCH|TRACE|CONNECT)\b/g, "attr-name": /:\w+/g}}, "response-status": {pattern: /^HTTP\/1.[01] [0-9]+.*/g, inside: {property: /[0-9]+[A-Z\s-]+$/g}}, keyword: /^[\w-]+:(?=.+)/gm};
var httpLanguages = {"application/json": Prism.languages.javascript, "application/xml": Prism.languages.markup, "text/xml": Prism.languages.markup, "text/html": Prism.languages.markup};
for (var contentType in httpLanguages)if (httpLanguages[contentType]) {
    var options = {};
    options[contentType] = {pattern: new RegExp("(content-type:\\s*" + contentType + "[\\w\\W]*?)\\n\\n[\\w\\W]*", "gi"), lookbehind: !0, inside: {rest: httpLanguages[contentType]}};
    Prism.languages.insertBefore("http", "keyword", options)
}
;
;
Prism.languages.ini = {comment: /^\s*;.*$/gm, important: /\[.*?\]/gm, constant: /^\s*[^\s\=]+?(?=[ \t]*\=)/gm, "attr-value": {pattern: /\=.*/gm, inside: {punctuation: /^[\=]/g}}};
;
Prism.hooks.add("after-highlight", function (e) {
    var t = e.element.parentNode;
    if (!t || !/pre/i.test(t.nodeName) || t.className.indexOf("line-numbers") === -1) {
        return
    }
    var n = 1 + e.code.split("\n").length;
    var r;
    lines = new Array(n);
    lines = lines.join("<span></span>");
    r = document.createElement("span");
    r.className = "line-numbers-rows";
    r.innerHTML = lines;
    if (t.hasAttribute("data-start")) {
        t.style.counterReset = "linenumber " + (parseInt(t.getAttribute("data-start"), 10) - 1)
    }
    e.element.appendChild(r)
})
;
(function () {
    if (!self.Prism)return;
    var e = /\b([a-z]{3,7}:\/\/|tel:)[\w-+%~/.:]+/, t = /\b\S+@[\w.]+[a-z]{2}/, n = /\[([^\]]+)]\(([^)]+)\)/, r = ["comment", "url", "attr-value", "string"];
    for (var i in Prism.languages) {
        var s = Prism.languages[i];
        Prism.languages.DFS(s, function (i, s) {
            if (r.indexOf(i) > -1) {
                s.pattern || (s = this[i] = {pattern: s});
                s.inside = s.inside || {};
                i == "comment" && (s.inside["md-link"] = n);
                s.inside["url-link"] = e;
                s.inside["email-link"] = t
            }
        });
        s["url-link"] = e;
        s["email-link"] = t
    }
    Prism.hooks.add("wrap", function (e) {
        if (/-link$/.test(e.type)) {
            e.tag = "a";
            var t = e.content;
            if (e.type == "email-link")t = "mailto:" + t; else if (e.type == "md-link") {
                var r = e.content.match(n);
                t = r[2];
                e.content = r[1]
            }
            e.attributes.href = t
        }
    })
})();
;
(function () {
    if (!self.Prism || !self.document || !document.querySelector)return;
    var e = {js: "javascript", html: "markup", svg: "markup", xml: "markup", py: "python"};
    Array.prototype.slice.call(document.querySelectorAll("pre[data-src]")).forEach(function (t) {
        var n = t.getAttribute("data-src"), r = (n.match(/\.(\w+)$/) || [, ""])[1], i = e[r] || r, s = document.createElement("code");
        s.className = "language-" + i;
        t.textContent = "";
        s.textContent = "Loading…";
        t.appendChild(s);
        var o = new XMLHttpRequest;
        o.open("GET", n, !0);
        o.onreadystatechange = function () {
            if (o.readyState == 4)if (o.status < 400 && o.responseText) {
                s.textContent = o.responseText;
                Prism.highlightElement(s)
            } else o.status >= 400 ? s.textContent = "✖ Error " + o.status + " while fetching file: " + o.statusText : s.textContent = "✖ Error: File does not exist or is empty"
        };
        o.send(null)
    })
})();
;
(function () {
    if (!self.Prism) {
        return
    }
    var e = {csharp: "C#", cpp: "C++"};
    Prism.hooks.add("before-highlight", function (t) {
        var n = e[t.language] || t.language;
        t.element.setAttribute("data-language", n)
    })
})();
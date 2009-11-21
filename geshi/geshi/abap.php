<?php
/*************************************************************************************
 * abap.php
 * --------
 * Author: Andres Picazo (andres@andrespicazo.com)
 * Contributors:
 *  - Sandra Rossi (sandra.rossi@gmail.com)
 *  - Jacob Laursen (jlu@kmd.dk)
 * Copyright: (c) 2007 Andres Picazo
 * Release Version: 1.0.8.4
 * Date Started: 2004/06/04
 *
 * ABAP language file for GeSHi.
 *
 * Reference abap language documentation (abap 7.1) : http://help.sap.com/abapdocu/en/ABENABAP_INDEX.htm
 *
 * ABAP syntax is highly complex, several problems could not be addressed, see TODO below if you dare ;-)
 * Be aware that in ABAP language, keywords may be composed of several tokens,
 *    separated by one or more spaces or carriage returns
 *    (for example CONCATENATE 'hello' 'world' INTO string SEPARATED  BY ' ')
 *    it's why we must decode them with REGEXPS. As there are many keywords with several tokens,
 *    I had to create a separate section in the code to simplify the reading.
 * Be aware that some words may be highlighted several times like for "ref to data", which is first
 *    highlighted for "ref to data", then secondly for "ref to". It is very important to
 *    position "ref to" after "ref to data" otherwise "data" wouldn't be highlighted because
 *    of the previous highlight.
 * Control, declarative and other statements are assigned URLs to sap documentation website:
 *    http://help.sap.com/abapdocu/en/ABAP<statement_name>.htm
 *
 * CHANGES
 * -------
 * 2009/02/25 (1.0.8.3)
 *   -  Some more rework of the language file
 * 2009/01/04 (1.0.8.2)
 *   -  Major Release, more than 1000 statements and keywords added = whole abap 7.1 (Sandra Rossi)
 * 2007/06/27 (1.0.0)
 *   -  First Release
 *
 * TODO
 * ----
 *   - in DATA data TYPE type, 2nd "data" and 2nd "type" are highlighted with data
 *     style, but should be ignored. Same problem for all words!!! This is quite impossible to
 *     solve it as we should define syntaxes of all statements (huge effort!) and use a lex
 *     or something like that instead of regexp I guess.
 *   - Some words are considered as being statement names (report, tables, etc.) though they
 *     are used as keyword in some statements. For example: FORM xxxx TABLES itab. It was
 *     arbitrary decided to define them as statement instead of keyword, because it may be
 *     useful to have the URL to SAP help for some of them.
 *   - if a comment is between 2 words of a keyword (for example SEPARATED "comment \n BY),
 *     it is not considered as a keyword, but it should!
 *   - for statements like "READ DATASET", GeSHi does not allow to set URLs because these
 *     statements are determined by REGEXPS. For "READ DATASET", the URL should be
 *     ABAPREAD_DATASET.htm. If a technical solution is found, be careful : URLs
 *     are sometimes not valid because the URL does not exist. For example, for "AT NEW"
 *     statement, the URL should be ABAPAT_ITAB.htm (not ABAPAT_NEW.htm).
 *     There are many other exceptions.
 *     Note: for adding this functionality within your php program, you can execute this code:
 *       function add_urls_to_multi_tokens( $matches ) {
 *           $url = preg_replace( "/[ \n]+/" , "_" , $matches[3] );
 *           if( $url == $matches[3] ) return $matches[0] ;
 *           else return $matches[1]."<a href=\"http://help.sap.com/abapdocu/en/ABAP".strtoupper($url).".htm\">".$matches[3]."</a>".$matches[4];
 *           }
 *       $html = $geshi->parse_code();
 *       $html = preg_replace_callback( "£(zzz:(control|statement|data);\">)(.+?)(</span>)£s", "add_urls_to_multi_tokens", $html );
 *       echo $html;
 *   - Numbers followed by a dot terminating the statement are not properly recognized
 *
 *************************************************************************************
 *
 *     This file is part of GeSHi.
 *
 *   GeSHi is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 *   GeSHi is distributed in the hope that it will be useful,
 *   but WITHOUT ANY WARRANTY; without even the implied warranty of
 *   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *   GNU General Public License for more details.
 *
 *   You should have received a copy of the GNU General Public License
 *   along with GeSHi; if not, write to the Free Software
 *   Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 *
 ************************************************************************************/

$language_data = array(
    'LANG_NAME' => 'ABAP',
    'COMMENT_SINGLE' => array(
        1 => '"'
        ),
    'COMMENT_MULTI' => array(),
    'COMMENT_REGEXP' => array(
        // lines beginning with star at 1st position are comments
        // (star anywhere else is not a comment, especially be careful with
        // "assign dref->* to <fs>" statement)
        2 => '/^\*.*?$/m'
        ),
    'CASE_KEYWORDS' => 0,
    'QUOTEMARKS' => array(
        1 => "'",
        2 => "`"
        ),
    'ESCAPE_CHAR' => '',

    'KEYWORDS' => array(
        //***********************************************
        // Section 2 : process sequences of several tokens
        //***********************************************

        7 => array(
            'at new',
            'at end of',
            'at first',
            'at last',
            'loop at',
            'loop at screen',
            ),

        8 => array(
            'private section',
            'protected section',
            'public section',
            'at line-selection',
            'at selection-screen',
            'at user-command',
            'assign component',
            'assign table field',
            'call badi',
            'call customer-function',
            'call customer subscreen',
            'call dialog',
            'call function',
            'call method',
            'call screen',
            'call selection-screen',
            'call transaction',
            'call transformation',
            'close cursor',
            'close dataset',
            'commit work',
            'convert date',
            'convert text',
            'convert time stamp',
            'create data',
            'create object',
            'delete dataset',
            'delete from',
            'describe distance',
            'describe field',
            'describe list',
            'describe table',
            'exec sql',
            'exit from sql',
            'exit from step-loop',
            'export dynpro',
            'export nametab',
            'free memory',
            'generate subroutine-pool',
            'get badi',
            'get bit',
            'get cursor',
            'get dataset',
            'get locale',
            'get parameter',
            'get pf-status',
            'get property',
            'get reference',
            'get run time',
            'get time',
            'get time stamp',
            'import directory',
            'insert report',
            'insert text-pool',
            'leave list-processing',
            'leave program',
            'leave screen',
            'leave to list-processing',
            'leave to transaction',
            'modify line',
            'modify screen',
            'move percentage',
            'open cursor',
            'open dataset',
            'raise event',
            'raise exception',
            'read dataset',
            'read line',
            'read report',
            'read table',
            'read textpool',
            'receive results from function',
            'refresh control',
            'rollback work',
            'set bit',
            'set blank lines',
            'set country',
            'set cursor',
            'set dataset',
            'set extended check',
            'set handler',
            'set hold data',
            'set language',
            'set left scroll-boundary',
            'set locale',
            'set margin',
            'set parameter',
            'set pf-status',
            'set property',
            'set run time analyzer',
            'set run time clock',
            'set screen',
            'set titlebar',
            'set update task',
            'set user-command',
            'suppress dialog',
            'truncate dataset',
            'wait until',
            'wait up to',
            ),

        9 => array(
            'accepting duplicate keys',
            'accepting padding',
            'accepting truncation',
            'according to',
            'actual length',
            'adjacent duplicates',
            'after input',
            'all blob columns',
            'all clob columns',
            'all fields',
            'all methods',
            'all other columns',
            'and mark',
            'and return to screen',
            'and return',
            'and skip first screen',
            'and wait',
            'any table',
            'appendage type',
            'archive mode',
            'archiving parameters',
            'area handle',
            'as checkbox',
            'as icon',
            'as line',
            'as listbox',
            'as person table',
            'as search patterns',
            'as separate unit',
            'as subscreen',
            'as symbol',
            'as text',
            'as window',
            'at cursor-selection',
            'at exit-command',
            'at next application statement',
            'at position',

            'backup into',
            'before output',
            'before unwind',
            'begin of block',
            'begin of common part',
            'begin of line',
            'begin of screen',
            'begin of tabbed block',
            'begin of version',
            'begin of',
            'big endian',
            'binary mode',
            'binary search',
            'by kernel module',
            'bypassing buffer',

            'client specified',
            'code page',
            'code page hint',
            'code page into',
            'color black',
            'color blue',
            'color green',
            'color pink',
            'color red',
            'color yellow',
            'compression off',
            'compression on',
            'connect to',
            'corresponding fields of table',
            'corresponding fields of',
            'cover page',
            'cover text',
            'create package',
            'create private',
            'create protected',
            'create public',
            'current position',

            'data buffer',
            'data values',
            'dataset expiration',
            'daylight saving time',
            'default key',
            'default program',
            'default screen',
            'defining database',
            'deleting leading',
            'deleting trailing',
            'directory entry',
            'display like',
            'display offset',
            'during line-selection',
            'dynamic selections',

            'edit mask',
            'end of block',
            'end of common part',
            'end of file',
            'end of line',
            'end of screen',
            'end of tabbed block',
            'end of version',
            'end of',
            'endian into',
            'ending at',
            'enhancement options into',
            'enhancement into',
            'environment time format',
            'execute procedure',
            'exporting list to memory',
            'extension type',

            'field format',
            'field selection',
            'field value into',
            'final methods',
            'first occurrence of',
            'fixed-point arithmetic',
            'for all entries',
            'for all instances',
            'for appending',
            'for columns',
            'for event of',
            'for field',
            'for high',
            'for input',
            'for lines',
            'for low',
            'for node',
            'for output',
            'for select',
            'for table',
            'for testing',
            'for update',
            'for user',
            'frame entry',
            'frame program from',
            'from code page',
            'from context',
            'from database',
            'from logfile id',
            'from number format',
            'from screen',
            'from table',
            'function key',

            'get connection',
            'global friends',
            'group by',

            'hashed table of',
            'hashed table',

            'if found',
            'ignoring case',
            'ignoring conversion errors',
            'ignoring structure boundaries',
            'implementations from',
            'in background',
            'in background task',
            'in background unit',
            'in binary mode',
            'in byte mode',
            'in char-to-hex mode',
            'in character mode',
            'in group',
            'in legacy binary mode',
            'in legacy text mode',
            'in program',
            'in remote task',
            'in text mode',
            'in table',
            'in update task',
            'include bound',
            'include into',
            'include program from',
            'include structure',
            'include type',
            'including gaps',
            'index table',
            'inheriting from',
            'init destination',
            'initial line of',
            'initial line',
            'initial size',
            'internal table',
            'into sortable code',

            'keep in spool',
            'keeping directory entry',
            'keeping logical unit of work',
            'keeping task',
            'keywords from',

            'left margin',
            'left outer',
            'levels into',
            'line format',
            'line into',
            'line of',
            'line page',
            'line value from',
            'line value into',
            'lines of',
            'list authority',
            'list dataset',
            'list name',
            'little endian',
            'lob handle for',
            'local friends',
            'locator for',
            'lower case',

            'main table field',
            'match count',
            'match length',
            'match line',
            'match offset',
            'matchcode object',
            'maximum length',
            'maximum width into',
            'memory id',
            'message into',
            'messages into',
            'modif id',

            'nesting level',
            'new list identification',
            'next cursor',
            'no database selection',
            'no dialog',
            'no end of line',
            'no fields',
            'no flush',
            'no intervals',
            'no intervals off',
            'no standard page heading',
            'no-extension off',
            'non-unique key',
            'non-unique sorted key',
            'not at end of mode',
            'number of lines',
            'number of pages',

            'object key',
            'obligatory off',
            'of current page',
            'of page',
            'of program',
            'offset into',
            'on block',
            'on commit',
            'on end of task',
            'on end of',
            'on exit-command',
            'on help-request for',
            'on radiobutton group',
            'on rollback',
            'on value-request for',
            'open for package',
            'option class-coding',
            'option class',
            'option coding',
            'option expand',
            'option syncpoints',
            'options from',
            'order by',
            'overflow into',

            'package section',
            'package size',
            'preferred parameter',
            'preserving identifier escaping',
            'primary key',
            'print off',
            'print on',
            'program from',
            'program type',

            'radiobutton groups',
            'radiobutton group',
            'range of',
            'reader for',
            'receive buffer',
            'reduced functionality',
            'ref to data',
            'ref to object',
            'ref to',

            'reference into',
            'renaming with suffix',
            'replacement character',
            'replacement count',
            'replacement length',
            'replacement line',
            'replacement offset',
            'respecting blanks',
            'respecting case',
            'result into',
            'risk level',

            'sap cover page',
            'search fkeq',
            'search fkge',
            'search gkeq',
            'search gkge',
            'section of',
            'send buffer',
            'separated by',
            'shared buffer',
            'shared memory',
            'shared memory enabled',
            'skipping byte-order mark',
            'sorted by',
            'sorted table of',
            'sorted table',
            'spool parameters',
            'standard table of',
            'standard table',
            'starting at',
            'starting new task',
            'statements into',
            'structure default',
            'structures into',

            'table field',
            'table of',
            'text mode',
            'time stamp',
            'time zone',
            'to code page',
            'to column',
            'to context',
            'to first page',
            'to last page',
            'to last line',
            'to line',
            'to lower case',
            'to number format',
            'to page',
            'to sap spool',
            'to upper case',
            'tokens into',
            'transporting no fields',
            'type tableview',
            'type tabstrip',

            'unicode enabling',
            'up to',
            'upper case',
            'using edit mask',
            'using key',
            'using no edit mask',
            'using screen',
            'using selection-screen',
            'using selection-set',
            'using selection-sets of program',

            'valid between',
            'valid from',
            'value check',
            'via job',
            'via selection-screen',
            'visible length',

            'whenever found',
            'with analysis',
            'with byte-order mark',
            'with comments',
            'with current switchstates',
            'with explicit enhancements',
            'with frame',
            'with free selections',
            'with further secondary keys',
            'with header line',
            'with hold',
            'with implicit enhancements',
            'with inactive enhancements',
            'with includes',
            'with key',
            'with linefeed',
            'with list tokenization',
            'with native linefeed',
            'with non-unique key',
            'with null',
            'with pragmas',
            'with precompiled headers',
            'with selection-table',
            'with smart linefeed',
            'with table key',
            'with test code',
            'with type-pools',
            'with unique key',
            'with unix linefeed',
            'with windows linefeed',
            'without further secondary keys',
            'without selection-screen',
            'without spool dynpro',
            'without trmac',
            'word into',
            'writer for'
            ),

        //**********************************************************
        // Other abap statements
        //**********************************************************
        3 => array(
            'add',
            'add-corresponding',
            'aliases',
            'append',
            'assign',
            'at',
            'authority-check',

            'break-point',

            'clear',
            'collect',
            'compute',
            'concatenate',
            'condense',
            'class',
            'class-events',
            'class-methods',
            'class-pool',

            'define',
            'delete',
            'demand',
            'detail',
            'divide',
            'divide-corresponding',

            'editor-call',
            'end-of-file',
            'end-enhancement-section',
            'end-of-definition',
            'end-of-page',
            'end-of-selection',
            'endclass',
            'endenhancement',
            'endexec',
            'endform',
            'endfunction',
            'endinterface',
            'endmethod',
            'endmodule',
            'endon',
            'endprovide',
            'endselect',
            'enhancement',
            'enhancement-point',
            'enhancement-section',
            'export',
            'extract',
            'events',

            'fetch',
            'field-groups',
            'find',
            'format',
            'form',
            'free',
            'function-pool',
            'function',

            'get',

            'hide',

            'import',
            'infotypes',
            'input',
            'insert',
            'include',
            'initialization',
            'interface',
            'interface-pool',
            'interfaces',

            'leave',
            'load-of-program',
            'log-point',

            'maximum',
            'message',
            'methods',
            'method',
            'minimum',
            'modify',
            'move',
            'move-corresponding',
            'multiply',
            'multiply-corresponding',

            'new-line',
            'new-page',
            'new-section',

            'overlay',

            'pack',
            'perform',
            'position',
            'print-control',
            'program',
            'provide',
            'put',

            'raise',
            'refresh',
            'reject',
            'replace',
            'report',
            'reserve',

            'scroll',
            'search',
            'select',
            'selection-screen',
            'shift',
            'skip',
            'sort',
            'split',
            'start-of-selection',
            'submit',
            'subtract',
            'subtract-corresponding',
            'sum',
            'summary',
            'summing',
            'supply',
            'syntax-check',

            'top-of-page',
            'transfer',
            'translate',
            'type-pool',

            'uline',
            'unpack',
            'update',

            'window',
            'write'

            ),

        //**********************************************************
        // keywords
        //**********************************************************

        4 => array(
            'abbreviated',
            'abstract',
            'accept',
            'acos',
            'activation',
            'alias',
            'align',
            'all',
            'allocate',
            'and',
            'assigned',
            'any',
            'appending',
            'area',
            'as',
            'ascending',
            'asin',
            'assigning',
            'atan',
            'attributes',
            'avg',

            'backward',
            'between',
            'bit-and',
            'bit-not',
            'bit-or',
            'bit-set',
            'bit-xor',
            'boolc',
            'boolx',
            'bound',
            'bt',
            'blocks',
            'bounds',
            'boxed',
            'by',
            'byte-ca',
            'byte-cn',
            'byte-co',
            'byte-cs',
            'byte-na',
            'byte-ns',

            'ca',
            'calling',
            'casting',
            'ceil',
            'center',
            'centered',
            'changing',
            'char_off',
            'charlen',
            'circular',
            'class_constructor',
            'client',
            'clike',
            'close',
            'cmax',
            'cmin',
            'cn',
            'cnt',
            'co',
            'col_background',
            'col_group',
            'col_heading',
            'col_key',
            'col_negative',
            'col_normal',
            'col_positive',
            'col_total',
            'color',
            'column',
            'comment',
            'comparing',
            'components',
            'condition',
            'context',
            'copies',
            'count',
            'country',
            'cpi',
            'creating',
            'critical',
            'concat_lines_of',
            'cos',
            'cosh',
            'count_any_not_of',
            'count_any_of',
            'cp',
            'cs',
            'csequence',
            'currency',
            'current',
            'cx_static_check',
            'cx_root',
            'cx_dynamic_check',

            'dangerous',
            'database',
            'datainfo',
            'date',
            'dbmaxlen',
            'dd/mm/yy',
            'dd/mm/yyyy',
            'ddmmyy',
            'deallocate',
            'decfloat',
            'decfloat16',
            'decfloat34',
            'decimals',
            'default',
            'deferred',
            'definition',
            'department',
            'descending',
            'destination',
            'disconnect',
            'display-mode',
            'distance',
            'distinct',
            'div',
            'dummy',

            'encoding',
            'end-lines',
            'engineering',
            'environment',
            'eq',
            'equiv',
            'error_message',
            'errormessage',
            'escape',
            'exact',
            'exception-table',
            'exceptions',
            'exclude',
            'excluding',
            'exists',
            'exp',
            'exponent',
            'exporting',
            'extended_monetary',

            'field',
            'filter-table',
            'filters',
            'filter',
            'final',
            'find_any_not_of',
            'find_any_of',
            'find_end',
            'floor',
            'first-line',
            'font',
            'forward',
            'for',
            'frac',
            'from_mixed',
            'friends',
            'from',

            'giving',
            'ge',
            'gt',

            'handle',
            'harmless',
            'having',
            'head-lines',
            'help-id',
            'help-request',
            'high',
            'hold',
            'hotspot',

            'id',
            'ids',
            'immediately',
            'implementation',
            'importing',
            'in',
            'initial',
            'incl',
            'including',
            'increment',
            'index',
            'index-line',
            'inner',
            'inout',
            'intensified',
            'into',
            'inverse',
            'is',
            'iso',

            'join',

            'key',
            'kind',

            'log10',
            'language',
            'late',
            'layout',
            'le',
            'lt',
            'left-justified',
            'leftplus',
            'leftspace',
            'left',
            'length',
            'level',
            'like',
            'line-count',
            'line-size',
            'lines',
            'line',
            'load',
            'long',
            'lower',
            'low',
            'lpi',

            'matches',
            'match',
            'mail',
            'major-id',
            'max',
            'medium',
            'memory',
            'message-id',
            'module',
            'minor-id',
            'min',
            'mm/dd/yyyy',
            'mm/dd/yy',
            'mmddyy',
            'mode',
            'modifier',
            'mod',
            'monetary',

            'name',
            'nb',
            'ne',
            'next',
            'no-display',
            'no-extension',
            'no-gap',
            'no-gaps',
            'no-grouping',
            'no-heading',
            'no-scrolling',
            'no-sign',
            'no-title',
            'no-topofpage',
            'no-zero',
            'nodes',
            'non-unicode',
            'no',
            'number',
            'nmax',
            'nmin',
            'not',
            'null',
            'numeric',
            'numofchar',

            'o',
            'objects',
            'obligatory',
            'occurs',
            'offset',
            'off',
            'of',
            'only',
            'open',
            'option',
            'optional',
            'options',
            'output-length',
            'output',
            'out',
            'on change of',
            'or',
            'others',

            'pad',
            'page',
            'pages',
            'parameter-table',
            'part',
            'performing',
            'pos_high',
            'pos_low',
            'priority',
            'public',
            'pushbutton',

            'queue-only',
            'quickinfo',

            'raising',
            'range',
            'read-only',
            'received',
            'receiver',
            'receiving',
            'redefinition',
            'reference',
            'regex',
            'replacing',
            'reset',
            'responsible',
            'result',
            'results',
            'resumable',
            'returncode',
            'returning',
            'right',
            'right-specified',
            'rightplus',
            'rightspace',
            'round',
            'rows',
            'repeat',
            'requested',
            'rescale',
            'reverse',

            'scale_preserving',
            'scale_preserving_scientific',
            'scientific',
            'scientific_with_leading_zero',
            'screen',
            'scrolling',
            'seconds',
            'segment',
            'shift_left',
            'shift_right',
            'sign',
            'simple',
            'sin',
            'sinh',
            'short',
            'shortdump-id',
            'sign_as_postfix',
            'single',
            'size',
            'some',
            'source',
            'space',
            'spots',
            'stable',
            'state',
            'static',
            'statusinfo',
            'sqrt',
            'string',
            'strlen',
            'structure',
            'style',
            'subkey',
            'submatches',
            'substring',
            'substring_after',
            'substring_before',
            'substring_from',
            'substring_to',
            'super',
            'supplied',
            'switch',

            'tan',
            'tanh',
            'table_line',
            'table',
            'tab',
            'then',
            'timestamp',
            'times',
            'time',
            'timezone',
            'title-lines',
            'title',
            'top-lines',
            'to',
            'to_lower',
            'to_mixed',
            'to_upper',
            'trace-file',
            'trace-table',
            'transporting',
            'trunc',
            'type',

            'under',
            'unique',
            'unit',
            'user-command',
            'using',
            'utf-8',

            'valid',
            'value',
            'value-request',
            'values',
            'vary',
            'varying',
            'version',

            'warning',
            'where',
            'width',
            'with',
            'word',
            'with-heading',
            'with-title',

            'xsequence',
            'xstring',
            'xstrlen',

            'yes',
            'yymmdd',

            'z',
            'zero'

            ),

        //**********************************************************
        // screen statements
        //**********************************************************

        5 => array(
            'call subscreen',
            'chain',
            'endchain',
            'on chain-input',
            'on chain-request',
            'on help-request',
            'on input',
            'on request',
            'on value-request',
            'process'
            ),

        //**********************************************************
        // internal statements
        //**********************************************************

        6 => array(
            'generate dynpro',
            'generate report',
            'import dynpro',
            'import nametab',
            'include methods',
            'load report',
            'scan abap-source',
            'scan and check abap-source',
            'syntax-check for dynpro',
            'syntax-check for program',
            'syntax-trace',
            'system-call',
            'system-exit',
            'verification-message'
            ),

        //**********************************************************
        // Control statements
        //**********************************************************

        1 => array(
            'assert',
            'case',
            'catch',
            'check',
            'cleanup',
            'continue',
            'do',
            'else',
            'elseif',
            'endat',
            'endcase',
            'endcatch',
            'endif',
            'enddo',
            'endloop',
            'endtry',
            'endwhile',
            'exit',
            'if',
            'loop',
            'resume',
            'retry',
            'return',
            'stop',
            'try',
            'when',
            'while'

            ),

        //**********************************************************
        // variable declaration statements
        //**********************************************************

        2 => array(
            'class-data',
            'controls',
            'constants',
            'data',
            'field-symbols',
            'fields',
            'local',
            'parameters',
            'ranges',
            'select-options',
            'statics',
            'tables',
            'type-pools',
            'types'
            )
        ),
    'SYMBOLS' => array(
        0 => array(
            '->*', '->', '=>',
            '(', ')', '{', '}', '[', ']', '+', '-', '*', '/', '!', '%', '^', '&', ':', ',', '.'
            ),
        1 => array(
            '>=', '<=', '<', '>', '='
            ),
        2 => array(
            '?='
            )
        ),
    'CASE_SENSITIVE' => array(
        GESHI_COMMENTS => false,
        1 => false,
        2 => false,
        3 => false,
        4 => false,
        5 => false,
        6 => false,
        7 => false,
        8 => false,
        9 => false,
        ),
    'STYLES' => array(
        'KEYWORDS' => array(
            1 => 'color: #000066; text-transform: uppercase; font-weight: bold; zzz:control;', //control statements
            2 => 'color: #cc4050; text-transform: uppercase; font-weight: bold; zzz:data;', //data statements
            3 => 'color: #005066; text-transform: uppercase; font-weight: bold; zzz:statement;', //first token of other statements
            4 => 'color: #500066; text-transform: uppercase; font-weight: bold; zzz:keyword;', // next tokens of other statements ("keywords")
            5 => 'color: #005066; text-transform: uppercase; font-weight: bold; zzz:statement;',
            6 => 'color: #000066; text-transform: uppercase; font-weight: bold; zzz:control;',
            7 => 'color: #000066; text-transform: uppercase; font-weight: bold; zzz:control;',
            8 => 'color: #005066; text-transform: uppercase; font-weight: bold; zzz:statement;',
            9 => 'color: #500066; text-transform: uppercase; font-weight: bold; zzz:keyword;'
            ),
        'COMMENTS' => array(
            1 => 'color: #808080; font-style: italic;',
            2 => 'color: #339933;',
            'MULTI' => 'color: #808080; font-style: italic;'
            ),
        'ESCAPE_CHAR' => array(
            0 => 'color: #000099; font-weight: bold;'
            ),
        'BRACKETS' => array(
            0 => 'color: #808080;'
            ),
        'STRINGS' => array(
            0 => 'color: #4da619;'
            ),
        'NUMBERS' => array(
            0 => 'color: #3399ff;'
            ),
        'METHODS' => array(
            1 => 'color: #202020;',
            2 => 'color: #202020;'
            ),
        'SYMBOLS' => array(
            0 => 'color: #808080;',
            1 => 'color: #800080;',
            2 => 'color: #0000ff;'
            ),
        'REGEXPS' => array(
            ),
        'SCRIPT' => array(
            )
        ),
    'URLS' => array(
        1 => 'http://help.sap.com/abapdocu/en/ABAP{FNAMEU}.htm',
        2 => 'http://help.sap.com/abapdocu/en/ABAP{FNAMEU}.htm',
        3 => 'http://help.sap.com/abapdocu/en/ABAP{FNAMEU}.htm',
        4 => '',
        5 => '',
        6 => '',
        7 => '',
        8 => '',
        9 => ''
        ),
    'OOLANG' => true,
    'OBJECT_SPLITTERS' => array(
        1 => '-&gt;',
        2 => '=&gt;'
        ),
    'REGEXPS' => array(
        ),
    'STRICT_MODE_APPLIES' => GESHI_NEVER,
    'SCRIPT_DELIMITERS' => array(
        ),
    'HIGHLIGHT_STRICT_BLOCK' => array(
        ),
    'PARSER_CONTROL' => array(
        'KEYWORDS' => array(
            7 => array(
                'SPACE_AS_WHITESPACE' => true
                ),
            8 => array(
                'SPACE_AS_WHITESPACE' => true
                ),
            9 => array(
                'SPACE_AS_WHITESPACE' => true
                )
            )
        ),
    'TAB_WIDTH' => 4
);

?>
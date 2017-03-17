<?php
/**
 * Plugin Skeleton: Displays "Hello World!"
 *
 * Syntax: <TEST> - will be replaced with "Hello World!"
 * 
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author     Christopher Smith <chris@jalakai.co.uk>
 */

if(!defined('DOKU_INC')) define('DOKU_INC',realpath(dirname(__FILE__).'/../../').'/');
if(!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');
require_once(DOKU_PLUGIN.'syntax.php');

/**
 * All DokuWiki plugins to extend the parser/rendering mechanism
 * need to inherit from this class
 */
class syntax_plugin_gfmcheckboxes extends DokuWiki_Syntax_Plugin {

   private $CHECKED_CHECKBOX = 0;
   private $UNCHECKED_CHECKBOX = 1;
   private $CHECKED_CHECKBOX_STRING = '<input type="checkbox" checked onclick="return false;">';
   private $UNCHECKED_CHECKBOX_STRING = '<input type="checkbox" onclick="return false;">';

   /**
    * Get the type of syntax this plugin defines.
    *
    * @param none
    * @return String <tt>'substition'</tt> (i.e. 'substitution').
    * @public
    * @static
    */
    function getType(){
        return 'substition';
    }

   /**
    * Where to sort in?
    *
    * @param none
    * @return Integer <tt>6</tt>.
    * @public
    * @static
    */
    function getSort(){
        return 999;
    }


   /**
    * Connect lookup pattern to lexer.
    *
    * @param $aMode String The desired rendermode.
    * @return none
    * @public
    * @see render()
    */
    function connectTo($mode) {
      $this->Lexer->addSpecialPattern('\[ \]',$mode,'plugin_gfmcheckboxes');
      $this->Lexer->addSpecialPattern('\[x\]',$mode,'plugin_gfmcheckboxes');
      $this->Lexer->addSpecialPattern('\[X\]',$mode,'plugin_gfmcheckboxes');
    }

   /**
    * Handler to prepare matched data for the rendering process.
    *
    * <p>
    * The <tt>$aState</tt> parameter gives the type of pattern
    * which triggered the call to this method:
    * </p>
    * <dl>
    * <dt>DOKU_LEXER_ENTER</dt>
    * <dd>a pattern set by <tt>addEntryPattern()</tt></dd>
    * <dt>DOKU_LEXER_MATCHED</dt>
    * <dd>a pattern set by <tt>addPattern()</tt></dd>
    * <dt>DOKU_LEXER_EXIT</dt>
    * <dd> a pattern set by <tt>addExitPattern()</tt></dd>
    * <dt>DOKU_LEXER_SPECIAL</dt>
    * <dd>a pattern set by <tt>addSpecialPattern()</tt></dd>
    * <dt>DOKU_LEXER_UNMATCHED</dt>
    * <dd>ordinary text encountered within the plugin's syntax mode
    * which doesn't match any pattern.</dd>
    * </dl>
    * @param $aMatch String The text matched by the patterns.
    * @param $aState Integer The lexer state for the match.
    * @param $aPos Integer The character position of the matched text.
    * @param $aHandler Object Reference to the Doku_Handler object.
    * @return Integer The current lexer state for the match.
    * @public
    * @see render()
    * @static
    */
    function handle($match, $state, $pos, &$handler){
        switch ($state) {
          case DOKU_LEXER_ENTER : 
            break;
          case DOKU_LEXER_MATCHED :
            break;
          case DOKU_LEXER_UNMATCHED :
            break;
          case DOKU_LEXER_EXIT :
            break;
          case DOKU_LEXER_SPECIAL :
             if (strpos($match, 'x') || strpos($match, 'X')){
                return $this->CHECKED_CHECKBOX;
             } else {
                return $this->UNCHECKED_CHECKBOX;
             }
            break;
        }
        return array();
    }

   /**
    * Handle the actual output creation.
    *
    * <p>
    * The method checks for the given <tt>$aFormat</tt> and returns
    * <tt>FALSE</tt> when a format isn't supported. <tt>$aRenderer</tt>
    * contains a reference to the renderer object which is currently
    * handling the rendering. The contents of <tt>$aData</tt> is the
    * return value of the <tt>handle()</tt> method.
    * </p>
    * @param $aFormat String The output format to generate.
    * @param $aRenderer Object A reference to the renderer object.
    * @param $aData Array The data created by the <tt>handle()</tt>
    * method.
    * @return Boolean <tt>TRUE</tt> if rendered successfully, or
    * <tt>FALSE</tt> otherwise.
    * @public
    * @see handle()
    */
    function render($mode, &$renderer, $data) {
        if($mode == 'xhtml'){
            switch ($data) {
                case $this->CHECKED_CHECKBOX:
                    $renderer->doc .= $this->CHECKED_CHECKBOX_STRING;
                    break;
                case $this->UNCHECKED_CHECKBOX:
                    $renderer->doc .= $this->UNCHECKED_CHECKBOX_STRING;
                    break;
                default:
                    return false;
                    break;
            }
            return true;
        }
        return false;
    }
}

//Setup VIM: ex: et ts=4 enc=utf-8 :
?>
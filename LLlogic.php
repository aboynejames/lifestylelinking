<?php
/**
 * LifestyleLinking
 *
 * Use this file to load the LifestyleLinking Framework.
 *
 *
 * LICENSE
 *
 * Copyright (c) 2004-2010 LifestyleLinking Open Source Project.  All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 * 1. Redistributions of source code must retain the above copyright
 *    notice, this list of conditions and the following disclaimer.
 * 2. Redistributions in binary form must reproduce the above copyright notice,
 *    this list of conditions and the following disclaimer in the documentation
 *    and/or other materials provided with the distribution.

 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @package    LifestyleLinking Open Source Project
 * @copyright  Copyright (c) 2010 James Littlejohn
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version    $Id$
 */




/**
 * @see exception handling
 */
require_once "library/exceptions.php";

/**
 * @see LLframeworkmanager class
 */
require_once "library/llframeworkmanager.php";

/**
 * @see LLcontext class
 */
require_once "library/llcontext.php";

/**
 * @see LLpath class
 */
require_once "library/llpath.php";

/**
 * @see LLJSON class
 */
require_once "library/llJSON.php";


/**
 * @see LLcore class
 */
require_once "library/llcore.php";

/**
 * @see LLassumptions class
 */
require_once "library/llexperimentation.php";

/**
 * @see LLcontent class
 */
require_once "library/management/llcontent.php";


/**
 * @see SimplePie class
 */
include_once('apis/simplepie/simplepie.class.php');
include_once('apis/simplepie/idn/idna_convert.class.php');


/**
 * @see LLdefinitions class
 */
require_once "library/management/lldefinitions.php";

/**
 * @see LLconfusionQuotent class
 */
require_once "library/logic/llconfusionquotent.php";

/**
 * @see LLwordWisdom class
 */
require_once "library/logic/llwordwisdom.php";

/**
 * @see LLmatrix class
 */
require_once "library/logic/llmatrix.php";

/**
 * @see LLstatistics class
 */
require_once "library/logic/llstatistics.php";

/**
 * @see LLavgOfavg class
 */
require_once "library/logic/llavgofavg.php";

/**
 * @see LLnormalization class
 */
require_once "library/logic/llnormalization.php";

/**
 * @see LLgroups class
 */
require_once "library/logic/llgroups.php";

/**
 * @see LLResults class
 */
require_once "library/llresults.php";

/**
 * @see LLlifestylelinking class
 */
require_once "library/logic/lllifestylelinking.php";

/**
 * @see apimanagement class
 */
require_once "library/management/llapi.php";

/**
 * @see LLrdf class
 */
require_once "library/management/llrdf.php";


/**
 * @see LLDataCleanser class
 */
require_once "library/management/lldatacleanser.php";


/**
 * @see http class
 */
require_once "apis/wikipedia.php";


?>
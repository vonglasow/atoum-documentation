Having fun with atoum
#######################

Report
*******
Test reports, can be decorated to be nicer to read. 
To do this in the  :ref:`configuration file <fichier-de-configuration>` of atoum, add the following code

.. code-block:: php

	<?php
	// by default .atoum.php
	// ...

	$stdout = new \mageekguy\atoum\writers\std\out;
	$report = new \mageekguy\atoum\reports\realtime\nyancat;
	$script->addReport($report->addWriter($stdout));

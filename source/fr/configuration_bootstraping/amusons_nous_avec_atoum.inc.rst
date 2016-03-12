Having fun with atoum
*********************

Report
******

Tests reports can be decorated to be more pleasant or fun to read.
To do this in the  :ref:`configuration file <fichier-de-configuration>` of atoum, add the following code

.. code-block:: php

	<?php
	// Default configuration file is .atoum.php
	// ...

	$stdout = new \mageekguy\atoum\writers\std\out;
	$report = new \mageekguy\atoum\reports\realtime\nyancat;
	$script->addReport($report->addWriter($stdout));

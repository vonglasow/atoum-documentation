Amusons nous avec atoum
#######################

Rapport
*******
Les rapports de tests, peuvent être décoré pour être plus sympa à lire. 
Pour cela, dans le :ref:`fichier de configuration <fichier-de-configuration>` d'atoum, ajoutez le code suivant

.. code-block:: php

	<?php
	// by default .atoum.php
	// ...

	$stdout = new \mageekguy\atoum\writers\std\out;
	$report = new \mageekguy\atoum\reports\realtime\nyancat;
	$script->addReport($report->addWriter($stdout));

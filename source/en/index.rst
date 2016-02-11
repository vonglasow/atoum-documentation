.. Documentation reST http://rest-sphinx-memo.readthedocs.org/en/latest/ReST.html
   In reST, the headers should be highlighted by = *-^ ' ~':.'"# and the order does not matter.
   Nevertheless, in the doc atoum, here's the selected order: #, *, =,-, ', ^, ',:,., ' "
   If you have more than 4 levels, split your file into multiple files.

What is atoum?
====================

atoum is a unit test framework like PHPUnit or SimpleTest, but it has a few advantages over these:

* It's modern and uses the innovations of the latest PHP's version (>= 5.3);
* It is simple and easy to learn;
* It is intuitive, its syntax is to be as close to the English natural language;
* despite the constant changes of atoum, backward compatibility is one of the priorities of its developers.

.. toctree::
   :maxdepth: 2

   start_with_atoum
   first_test
   running_tests
   how_to_write_test_cases
   asserters
   mocking_systems
   engine
   mode-loop
   mode-debug
   initialization_method
   cookbook
   configuration_bootstraping
   ide
   option_cli
   extensions
   contribute
   annotations
   licences

<?php
ini_set('display_errors', 1);
    class LearningPath {
        private $pathName;
        private $pathCreator;
        private $pathDescription;
        protected $pathResources;

        // Constructor
        public function __construct($name, $creator, $desc, $resources)
        {
            $this->pathName = $name;
            $this->pathCreator = $creator;
            $this->pathDescription = $desc;
            $this->pathResources = $resources;
        }

        // Getter
        public function __get($property) {
            if (property_exists($this, $property)) {
                return $this->$property;
            }
        }
        // Setter
        public function __set($property, $value) {
            if (property_exists($this, $property)) {
                $this->$property = $value;
            }
        }
    }

    class Resources extends LearningPath {
        protected $resourceName;
        protected $resourceUrl;

        public function __construct($name, $url)
        {
            $this->resourceName = $name;
            $this->resourceUrl = $url;
        }
    }

    // Testing:
    $resource = array(
        'Resource 1' => new Resources('Test', 'www.test.com'),
        'Resource 2' => new Resources('Test2', 'www.test2.com')
);
    $objTest = new LearningPath('PHP', 'Jay', 'Test desc.', $resource);

    echo "Object Name: " . $objTest->__get('pathName') . "<br>";
    echo "Object Creator: " . $objTest->__get('pathCreator') . "<br>";
    echo "Object Description: " . $objTest->__get('pathDescription') . "<br>";
    echo "Object Resource 1 Name: " . $objTest->__get('pathResources')['Resource 1']->__get('resourceName') . "<br>";
    echo "Object Resource 1 URL: " . $objTest->__get('pathResources')['Resource 1']->__get('resourceUrl') . "<br>";
    echo "Object Resource 2 Name: " . $objTest->__get('pathResources')['Resource 2']->__get('resourceName') . "<br>";
    echo "Object Resource 2 URL: " . $objTest->__get('pathResources')['Resource 2']->__get('resourceUrl') . "<br>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- Learning paths with the ability to view, create, edit, and delete. -->
    <!-- TO DO:
            * storage for learning paths -->
    <h3>Learning Paths</h3>
    

</body>
</html>
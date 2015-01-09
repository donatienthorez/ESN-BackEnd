<?php
header('Content-Type: application/json; charset=utf-8');
ini_set('display_errors', 1);

class CategoryModel{

    private $database;
    private $connexion;
    
    public function CategoryModel($database)
    {
        $this->database=$database;
        $this->connexion=$database->connexion;
    }
    
    
    
    function addCategory($parent,$category)
    {
		try{
			$stmt = $this->connexion->prepare("INSERT INTO categories(name,content,code_section) VALUES (:name,:content,:code_section)");
			$stmt->bindParam(':name',$category->name);
			$stmt->bindParam(':content',$category->content);
			$stmt->bindParam(':code_section',$category->section);
			$stmt->execute();
			
			$id = $this->connexion->lastInsertId();
			echo 'id:' . $id; 
			
			if($parent == 0)
			{
				$partie=0;
				$chapitre=0;
			}
			else 
			{
				
				$stmt = $this->connexion->prepare("SELECT * from relation WHERE idCategorie=:id");
				$stmt->bindParam(':id',$parent);
				$stmt->execute();
				
				$data=$stmt->fetch(PDO::FETCH_OBJ);
				if($data){
				
					if($data->chapitre == 0){
					
						if($data->partie == 0)
						{
							$partie=$data->idCategorie;
							$chapitre=0;
						}
						else
						{
							$partie=$data->partie;
							$chapitre=$data->idCategorie;
						}
					}
					else
					{
						throw new Exception('The category you want to add are too deep');
					}
				}
				else
				{
					throw new Exception('The parent category doesn\' exist');
				}
			}
			
			$stmt = $this->connexion->prepare("INSERT INTO relation(idCategorie,partie,chapitre) VALUES (:id,:partie,:chapitre)");
			$stmt->bindParam(':id',$id);
			$stmt->bindParam(':partie',$partie);
			$stmt->bindParam(':chapitre',$chapitre);
			$stmt->execute();
			
			
		}
        catch (Exception $e)
        {
            if($id!=0)
            {
				$this->deleteCategory($id);
			}
            die('Erreur : ' . $e->getMessage());
        }
	}
	
	function deleteCategory($id)
	{
		try{
			
			$stmt = $this->connexion->prepare("DELETE FROM relation WHERE idCategorie=:idCategorie");
			$stmt->bindParam(':idCategorie',$id);
			$stmt->execute();
			
			$stmt = $this->connexion->prepare("DELETE FROM categories WHERE idCategorie=:idCategorie");
			$stmt->bindParam(':idCategorie',$id);
			$stmt->execute();
		}
        catch (Exception $e)
        {
            die('Erreur : ' . $e->getMessage());
        }
	}
    
    function updateNameCategories($id,$name)
    {
		try{
			$stmt = $this->connexion->prepare("UPDATE categories SET name=:name WHERE idCategorie=:idCategorie");
			$stmt->bindParam(':name',$name);
			$stmt->bindParam(':idCategorie',$id);
			$stmt->execute();
		}
        catch (Exception $e)
        {
            die('Erreur : ' . $e->getMessage());
        }
	}
	function updateContentCategories($id,$content)
    {
		try{
			$stmt = $this->connexion->prepare("UPDATE categories SET content=:content WHERE idCategorie=:idCategorie");
			$stmt->bindParam(':content',$content);
			$stmt->bindParam(':idCategorie',$id);
			$stmt->execute();
		}
        catch (Exception $e)
        {
            die('Erreur : ' . $e->getMessage());
        }
	}

    function getCategories($section)
    {
	try{
            $stmt = $this->connexion->prepare("SELECT * from relation, categories WHERE code_section=:section and relation.idCategorie=categories.idCategorie order by partie ASC, chapitre ASC");
            $stmt->bindParam(':section',$section);
            $stmt->execute();

            $categories=array();
            
            while($data=$stmt->fetch(PDO::FETCH_OBJ))
            {
                $c = new Category($data->idCategorie,$data->name,$data->code_section,$data->content);
                
                if ($data->partie == 0 && $data->chapitre == 0)
                {
                    array_push($categories,$c);
                }
                else {
                       foreach($categories as $value)
                       {
                           if($value->id == $data->partie)
                           {
                               if($data->chapitre == 0)
                               {
                                $value->addCategoryToList($c);
                               }
                               else
                               {
                                $value->addSubcategoryToList($data);
                               }
                           }
                           
                        }
                    }
                        
                
            }
        }
        catch (Exception $e)
        {
            die('Erreur : ' . $e->getMessage());
        }
        $test['categories'] = $categories;
	return $test;
    }	
    
    
}



class AdminController {
    private $db;

    public function __construct() {
        AuthMiddleware::requireAdmin();
        $this->db = new Database();
    }

    public function index() {
        $questions = $this->db->query("SELECT * FROM questions ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
        require '../app/views/admin/questions.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $text_de = $_POST['text_de'];
            $text_en = $_POST['text_en'];
            $choices = [$_POST['choice1_de'], $_POST['choice2_de'], $_POST['choice3_de'], $_POST['choice4_de']];
            $choices_en = [$_POST['choice1_en'], $_POST['choice2_en'], $_POST['choice3_en'], $_POST['choice4_en']];
            $correct_index = (int)$_POST['correct_choice_index'];

            $image_path = null;
            if (!empty($_FILES['image']['name'])) {
                $file = $_FILES['image'];
                $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
                if (in_array($ext, ['jpg', 'jpeg', 'png'])) {
                    $image_path = 'uploads/' . uniqid() . '.' . $ext;
                    move_uploaded_file($file['tmp_name'], $image_path);
                }
            }

            $this->db->query(
                "INSERT INTO questions (text_de, text_en, image_path,
                 choice1_de, choice1_en, choice2_de, choice2_en, 
                 choice3_de, choice3_en, choice4_de, choice4_en, correct_choice_index)
                 VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
                [$text_de, $text_en, $image_path,
                 $choices[0], $choices_en[0], $choices[1], $choices_en[1],
                 $choices[2], $choices_en[2], $choices[3], $choices_en[3],
                 $correct_index]
            );
            header("Location: /Admin/index");
        } else {
            require '../app/views/admin/create.php';
        }
    }

    public function delete() {
        $id = $_GET['id'];
        $this->db->query("DELETE FROM questions WHERE id = ?", [$id]);
        header("Location: /Admin/index");
    }
}

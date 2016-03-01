package ywd;

import java.io.IOException;
import java.io.InputStream;
import java.util.Properties;

public class Main {
    public static void main(String[] args) throws IOException {
        Properties props = new Properties();
        InputStream in = Main.class.getResourceAsStream("../props.properties");
        props.load(in);
        
        Operator operator = new Operator(props);
        operator.uploadFolder(props.getProperty("uploadFolder"));
        in.close();
    }
}

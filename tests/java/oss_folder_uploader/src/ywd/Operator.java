package ywd;

import java.io.File;
import java.io.IOException;
import java.util.Properties;

import com.aliyun.oss.OSSClient;
import com.aliyun.oss.model.PutObjectRequest;

/**
 * Customized operation methods center.
 */
public class Operator {

    private String Endpoint;
    private String AccessKeyId;
    private String AccessKeySecret;
    private String CasaroverBucket;

    public Operator(Properties props) throws IOException {
        this.Endpoint = props.getProperty("Endpoint");
        this.AccessKeyId = props.getProperty("AccessKeyId");
        this.AccessKeySecret = props.getProperty("AccessKeySecret");
        this.CasaroverBucket = props.getProperty("CasaroverBucket");
    }

    public void uploadFolder(String folderPath) {
        String folderName = getFolderName(folderPath);
        File folder = new File(folderPath);
        File[] files = folder.listFiles();
        for (File file : files) {
            if (file.isFile()) {
                String key = folderName + "/" + file.getName();
                uploadFile(key, file.getPath());
            } else {
                System.out.println("Warning: " +file.getPath() + " is a folder!");
            }
        }
    }

    public void uploadFile(String key, String filePath) {
        OSSClient client = new OSSClient(Endpoint, AccessKeyId, AccessKeySecret);
        client.putObject(new PutObjectRequest(CasaroverBucket, key, new File(filePath)));
        client.shutdown();
    }

    private String getFolderName(String folderPath) {
        String folderName = "";
        if (folderPath.lastIndexOf("/") >= 0) {
            String[] folderNames = folderPath.split("/");
            int size = folderNames.length;
            folderName = folderNames[size - 1];
        } else if (folderPath.lastIndexOf("\\") >= 0) {
            String[] folderNames = folderPath.split("\\");
            int size = folderNames.length;
            folderName = folderNames[size - 1];
        } else {
            folderName = folderPath;
        }
        return folderName;
    }
}
package test;

import com.aliyun.oss.ClientConfiguration;
import com.aliyun.oss.OSSClient;
import com.aliyun.oss.model.ListObjectsRequest;
import com.aliyun.oss.model.OSSObjectSummary;
import com.aliyun.oss.model.ObjectListing;

public class OSSClientTest {

    static final String Endpoint = "http://oss-cn-hangzhou.aliyuncs.com";
    static final String AccessKeyId = "d0hCgVaodbRF98Z4";
    static final String AccessKeySecret = "d1JCg4vwmT4j7hNXFipxbtae7AL54a";
    static final String CasaroverBucket = "casarover";

    public static ClientConfiguration setConfig() {
        // Create a new client configuration instance
        ClientConfiguration conf = new ClientConfiguration();

        // Set the maximum number of allowed open HTTP connections
        conf.setMaxConnections(100);

        // Set the amount of time to wait (in milliseconds) when initially establishing 
        // a connection before giving up and timing out
        conf.setConnectionTimeout(5000);

        // Set the maximum number of retry attempts for failed retryable requests
        conf.setMaxErrorRetry(3);

        // Set the amount of time to wait (in milliseconds) for data to betransfered over 
        // an established connection before the connection times out and is closed
        conf.setSocketTimeout(2000);
        
        return conf;
    }
    public static void main(String[] args) {
        
        // Create a new OSSClient instance
        OSSClient client = new OSSClient(Endpoint, AccessKeyId, AccessKeySecret);
        
        // Do some operations with the instance...
        ObjectListing objectListing = client.listObjects(new ListObjectsRequest(CasaroverBucket)
                //.withPrefix("My")
                );
        for (OSSObjectSummary objectSummary : objectListing.getObjectSummaries()) {
            System.out.println(" - " + objectSummary.getKey() + "  " + 
                    "(size = " + objectSummary.getSize() + ")");
        }

        // Shutdown the instance to release any allocated resources
        client.shutdown();
    }
}
